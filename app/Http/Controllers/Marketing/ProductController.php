<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductPrice;
use App\Models\Category;
use App\Models\Location;
use Illuminate\View\View;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use OAuth1NetsuiteClientCreator;
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
        $product->category_id = $request->category_id;
        $product->weight = 21.5;
        $product->length = 42.9;
        $product->width = 62.7;
        $product->height = 20.6;

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
        $product->category_id = $request->category_id;
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
}
