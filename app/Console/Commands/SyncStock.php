<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductPrice;
use App\Models\Category;
use App\Models\Location;
use App\Traits\OAuth1NetsuiteClientCreator;
use App\Services\NetsuiteProductsService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SyncStock extends Command
{
    use OAuth1NetsuiteClientCreator;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync products from netsuite';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting synchronization...');
        $start = microtime(true);

        $netsuiteProductService = new NetsuiteProductsService();
        $client = $netsuiteProductService->getNetsuiteClient();
        $page = 1;

        try {
            do {
                $products = $netsuiteProductService->fetchProductsFromNetSuite($client, $page);

                if (empty($products)) {
                    break;
                }

                DB::beginTransaction();
                try {
                    $this->processProducts($products);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }

                $page++;
            } while (!empty($products));

            $this->info('Synchronization completed successfully.');
        } catch (\Exception $e) {
            $this->error("Synchronization failed: " . $e->getMessage());
        }

        $end = microtime(true);
        $time = $end - $start;
        $this->info("Sync duration: {$time} seconds");
    }


    private function processProducts($products)
    {
        $groupedProducts = $this->groupProduct($products);

        foreach ($groupedProducts as $product) {
            $dbProduct = $this->updateOrCreateProduct($product);
            $this->info("Productos actualizados o creados...");
            $this->updateStock($product, $dbProduct);
            $this->info("Stock y Locaciones actualizadas o creadas...");
            $this->updatePrices($product, $dbProduct);
            $this->info("Precios creados o actualizados...");
            $this->updateFeatured($dbProduct);
            $this->info("Imagenes actualizadas...");
        }
    }

    private function groupProduct($products)
    {
        $groupedProducts = [];
        foreach ($products as $product) {
            $itemId = $product['ID'];
            if (!isset($groupedProducts[$itemId])) {
                $groupedProducts[$itemId] = $product;
            }
        }

        return $groupedProducts;
    }

    private function updateOrCreateProduct($product)
    {
        $productName = $product['NOMBRE_PARA_MOSTRAR_EN_LA_TIENDA_WEB'] ?: $product['NOMBRE'];
        $dbProduct = Product::updateOrCreate(
            ['netsuite_id' => $product['ID']],
            [
                'name' => $productName,
                'description' => $product['DESCRIPCION_DETALLADA'],
                'netsuite_id' => $product['ID'],
                'netsuite_item' => $product['ARTICULO'],
            ]
        );

        return $dbProduct;
    }

    private function updateStock($product, $dbProduct)
    {
        if (!empty($product['EXISTENCIA'])) {
            foreach ($product['EXISTENCIA'] as $stock) {
                $location = Location::firstOrCreate(
                    ['netsuite_id' => $stock['location']],
                    ['netsuite_name' => $stock['locationTxt']]
                );

                ProductStock::updateOrCreate(
                    ['product_id' => $dbProduct->id, 'location_id' => $location->id],
                    [
                        'quantity_on_hand' => $stock['quantityonhand'],
                        'quantity_available' => $stock['quantityavailable'],
                        'quantity_on_order' => $stock['quantityonorder'],
                        'quantity_in_transit' => $stock['quantityintransit'],
                    ]
                );
            }
        }
    }

    private function updatePrices($product, $dbProduct)
    {
        if (!empty($product['PRECIOS'])) {
            foreach ($product['PRECIOS'] as $price) {
                if (!empty($price['NIVEL']) && !empty($price['PRECIO'])) {
                    ProductPrice::updateOrCreate(
                        ['product_id' => $dbProduct->id, 'level' => $price['NIVEL']],
                        ['price' => $price['PRECIO']]
                    );
                }
            }
        }
    }


    private function updateFeatured($dbProduct)
    {
        $name = $dbProduct->netsuite_item . '.webp';

        if (Storage::disk('public')->exists('featured_images/'. $name)) {
            $dbProduct->featured = 'featured_images/' . $name;
            $dbProduct->save();
        }
    }
}
