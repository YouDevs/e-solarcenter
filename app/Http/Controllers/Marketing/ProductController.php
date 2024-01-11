<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use GuzzleHttp\Client,
    GuzzleHttp\HandlerStack,
    GuzzleHttp\Handler\CurlHandler,
    GuzzleHttp\Subscriber\Oauth\Oauth1;

use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::all();
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
            'query' => ['script' => '2377', 'deploy' => '1'],
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        ]);

        $products = json_decode($response->getBody(), true);

        // Agrupar productos por ID
        $groupedProducts = [];
        foreach ($products as $product) {
            $itemId = $product['item'];
            if (!isset($groupedProducts[$itemId])) {
                $groupedProducts[$itemId] = $product;
                $groupedProducts[$itemId]['quantityavailable'] = 0;
            }
            $groupedProducts[$itemId]['quantityavailable'] += $product['quantityavailable'];
        }

        /*
            "item" => "3050"
            "itemTxt" => "PV-DC-PTO-HYM"
            "description" => "HERRAMIENTA DESCONECTORA DE PUERTO HYM"
            "location" => "2"
            "locationTxt" => "GUADALAJARA"
            "quantityonhand" => "10"
            "quantityavailable" => 15
            "quantityonorder" => "0"
            "quantityintransit" => "0"
        */

        // Guardar en la base de datos
        foreach ($groupedProducts as $product) {
            // Aquí debes adaptar esta parte a tu modelo y estructura de base de datos
            Log::info($product['item']);
            $dbProduct = Product::updateOrCreate(
                ['netsuite_item' => $product['item']],
                [
                    'name' => $product['description'],
                    'brand' => 'N/A',
                    'netsuite_item' => $product['item'],
                    'netsuite_item_txt' => $product['itemTxt'],
                    'netsuite_stock' => $product['quantityavailable'],
                ]
            );
        }

        session()->flash('message', 'Productos almacenados desde netsuite correctamente!');
        session()->flash('icon', 'success');

        return redirect()->route('admin.products.index');
    }

    public function createOAuth1Client($endpoint, $consumer_key, $consumer_secret, $token_secret, $token, $realm)
    {
        Log::info('createOAuth1Client');
        $handler = new CurlHandler();
        $stack = HandlerStack::create($handler);

        $middleware = new Oauth1([
            'consumer_key'    => $consumer_key,
            'consumer_secret' => $consumer_secret,
            'token_secret'    => $token_secret,
            'token'           => $token,
            'version'         => '1.0',
            'realm'           => $realm,
            'signature_method' => Oauth1::SIGNATURE_METHOD_HMACSHA256
        ]);

        Log::info('middleware', ['m' => $middleware]);

        $stack->push($middleware);

        return new Client([
            'base_uri' => $endpoint,
            'handler' => $stack,
            'auth' => 'oauth'
        ]);
    }
}
