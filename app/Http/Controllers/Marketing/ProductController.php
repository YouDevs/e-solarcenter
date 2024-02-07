<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\OAuth1ClientCreator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use OAuth1ClientCreator;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('marketing.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('marketing.products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product;

        // Subir la ficha técnica (PDF)
        if ($request->hasFile('data_sheet')) {
            $product->data_sheet = $request->file('data_sheet')->store('data_sheets', 'public');
        }

        // Subir la imagen destacada
        if ($request->hasFile('featured')) {
            $product->featured = $request->file('featured')->store('featured_images', 'public');
        }

        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->sku = $request->sku;
        $product->save();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('marketing.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Subir la ficha técnica (PDF)
        if ($request->hasFile('data_sheet')) {
            $product->data_sheet = $request->file('data_sheet')->store('data_sheets', 'public');
        }

        // Subir la imagen destacada
        if ($request->hasFile('featured')) {
            $product->featured = $request->file('featured')->store('featured_images', 'public');
        }

        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->sku = $request->sku;
        $product->save();

        session()->flash('message', 'Producto actualizado exitosamente');
        session()->flash('icon', 'success');

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('message', 'Producto eliminado exitosamente');
        session()->flash('icon', 'success');

        return redirect()->route('admin.products.index');
    }

    //NOTA: este método lo desarrollé solo para probar la integración con netsuite.
    public function getProductsFromNetsuite()
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
            'query' => ['script' => '2375', 'deploy' => '1'],
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        ]);

        $products = json_decode($response->getBody(), true);
        dd($products);
        // Agrupar productos por ID
        $groupedProducts = [];

        foreach ($products as $product) {
            /*
                "ID" => "2836"
                "ARTICULO" => "PV-PS-555-LNG"
                "NOMBRE" => "PAN SOL LONGI MONOPERC HALFCELL 555W"
                "NOMBRE_PARA_MOSTRAR_EN_LA_TIENDA_WEB" => ""
                "DESCRIPCION_DETALLADA" => ""
                "FICHA_TECNICA_SOLAR_CENTER_ID" => "149342"
                "FICHA_TECNICA_SOLAR_CENTER_TXT" => "Fuicha tec lng"
                "FICHA_TECNICA_SOLAR_CENTER_URL" => "/core/media/media.nl?id=110991&c=&h=6-7O4_lBjPzVIz19KLQcbQOtxu3KHOygTtWOuBxju5ZzzjO1&_xt=.pdf"
                "PRECIOS"
            */
            $itemId = $product['ID'];
            if (!isset($groupedProducts[$itemId])) {
                $groupedProducts[$itemId] = $product;
                // $groupedProducts[$itemId]['quantityavailable'] = 0;
            }
            // $groupedProducts[$itemId]['quantityavailable'] += $product['quantityavailable'];
        }

        // Guardar en la base de datos
        foreach ($groupedProducts as $product) {
            // Log::info($product['FICHA_TECNICA_SOLAR_CENTER_URL']);

            // // URL completa de la ficha técnica:
            // $dataSheetUrl = 'https://5874559-sb1.app.netsuite.com' . $product['FICHA_TECNICA_SOLAR_CENTER_URL'];

            // // Utiliza Guzzle para descargar el archivo
            // $dataSheetResponse = $client->get($dataSheetUrl, ['stream' => true]);
            // $dataSheetContents = $dataSheetResponse->getBody()->getContents();
            // Log::info($dataSheetContents);
            // // Define un nombre de archivo y ruta en el storage de Laravel
            // $fileName = 'data_sheets/' . $product['item'] . '.pdf';
            // Storage::put($fileName, $dataSheetContents);

            // Aquí debes adaptar esta parte a tu modelo y estructura de base de datos
            $dbProduct = Product::updateOrCreate(
                ['netsuite_item' => $product['ID']],
                [
                    'name' => $product['NOMBRE'],
                    'brand' => 'N/A',
                    'price' => $product['PRECIOS'][0]['PRECIO'],
                    'netsuite_item' => $product['ID'],
                    'netsuite_item_txt' => $product['FICHA_TECNICA_SOLAR_CENTER_TXT'],
                    'netsuite_stock' => $product['quantityavailable'],
                    // 'data_sheet' => $fileName,
                ]
            );
        }

        session()->flash('message', 'Productos almacenados desde netsuite correctamente!');
        session()->flash('icon', 'success');

        return redirect()->route('admin.products.index');
    }
}
