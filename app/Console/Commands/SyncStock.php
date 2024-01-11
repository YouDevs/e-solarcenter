<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Traits\OAuth1ClientCreator;
use Illuminate\Support\Facades\Log;

class SyncStock extends Command
{
    use OAuth1ClientCreator;
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
    protected $description = 'Sync products stock from all netsuite locations per item.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = microtime(true);

        $this->syncStock();

        $end = microtime(true);
        $time = $end-$start;
        Log::info("----> sync stock duration: {$time}");
    }

    private function syncStock()
    {
        $endpoint = 'https://5874559-sb1.restlets.api.netsuite.com/app/';

        $client = $this->createOAuth1Client(
            $endpoint,
            config('app.consumer_key'),
            config('app.consumer_secret'),
            config('app.token_secret'),
            config('app.token'),
            config('app.realm')
        );

        $response = $client->get('site/hosting/restlet.nl', [
            'query' => ['script' => '2377', 'deploy' => '1'],
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        ]);

        $products = json_decode($response->getBody(), true);
        // Agrupa productos por ID
        $groupedProducts = [];
        foreach ($products as $product) {
            $itemId = $product['item'];
            if (!isset($groupedProducts[$itemId])) {
                $groupedProducts[$itemId] = $product;
                $groupedProducts[$itemId]['quantityavailable'] = 0;
            }
            $groupedProducts[$itemId]['quantityavailable'] += $product['quantityavailable'];
        }

        // Actualiza el stock de cada producto si existe y si es diferente del stock de netsuite.
        foreach ($groupedProducts as $product) {
            $dbProduct = Product::firstWhere('netsuite_item', $product['item']);

            if ($dbProduct && $dbProduct->netsuite_stock != $product['quantityavailable']) {
                $dbProduct->update([
                    'netsuite_stock' => $product['quantityavailable'],
                ]);
            }
        }

        return 0;
    }
}
