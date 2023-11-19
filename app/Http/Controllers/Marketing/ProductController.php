<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

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
    public function create() : View
    {
        $categories = Category::all();
        return view('marketing.products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validación de datos
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category_id' => 'required',
            // otras validaciones...
            'data_sheet' => 'required|file|mimes:pdf', // Asegúrate de validar el archivo PDF
            'featured' => 'required|image', // Valida que sea una imagen
        ]);

        $product = new Product;

        // Subir la ficha técnica (PDF)
        if ($request->hasFile('data_sheet')) {
            $product->data_sheet = $request->file('data_sheet')->store('data_sheets', 'public');
            // dd($product->data_sheet);
        }

        // Subir la imagen destacada
        if ($request->hasFile('featured')) {
            $product->featured = $request->file('featured')->store('featured_images', 'public');
        }

        $product->name = $request->name;
        $product->brand = $request->brand;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
