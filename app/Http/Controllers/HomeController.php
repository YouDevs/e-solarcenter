<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::query();

        // Filtra los productos por categoría si se proporciona category_id
        if ($request->has('category_id')) {
            $products->where('category_id', $request->category_id);
        }

        $products->orderBy('id', 'DESC');

        $products = $products->get()->map(function ($product) {
            $product->featured_url = Storage::url($product->featured);
            $product->data_sheet_url = $product->data_sheet ? Storage::url($product->data_sheet): null;
            return $product;
        });

        return view('index', compact('products'));
    }

    public function productByFilter(Request $request, Product $product)
    {
        $related_products = Product::all();
        // dd($related_products);
        return view('product', compact('product', 'related_products'));

        // $searchTerm = $request->search_term;

        // $products = Product::query();
        // $products->with('category');

        // if ($searchTerm) {
        //     $products = $products->where(function ($query) use ($searchTerm) {
        //         $query->where('name', 'LIKE', "%{$searchTerm}%")
        //             ->orWhere('brand', 'LIKE', "%{$searchTerm}%")
        //             ->orWhereHas('category', function ($subQuery) use ($searchTerm) {
        //                 $subQuery->where('name', 'LIKE', "%{$searchTerm}%");
        //             });
        //     });
        // } else {
        //     $products = $products->orderBy('id', 'DESC');
        // }

        // $products = $products->get()->map(function ($product) {
        //     $product->featured_url = Storage::url($product->featured);
        //     $product->data_sheet_url = Storage::url($product->data_sheet);
        //     return $product;
        // });

        // return response()->json(['products' => $products]);
    }

    public function productsByCategory(Request $request, Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();

        return view('category', compact('products'));

        // $searchTerm = $request->search_term;

        // $products = Product::query();
        // $products->with('category');

        // if ($searchTerm) {
        //     $products = $products->where(function ($query) use ($searchTerm) {
        //         $query->where('name', 'LIKE', "%{$searchTerm}%")
        //             ->orWhere('brand', 'LIKE', "%{$searchTerm}%")
        //             ->orWhereHas('category', function ($subQuery) use ($searchTerm) {
        //                 $subQuery->where('name', 'LIKE', "%{$searchTerm}%");
        //             });
        //     });
        // } else {
        //     $products = $products->orderBy('id', 'DESC');
        // }

        // $products = $products->get()->map(function ($product) {
        //     $product->featured_url = Storage::url($product->featured);
        //     $product->data_sheet_url = Storage::url($product->data_sheet);
        //     return $product;
        // });

        // return response()->json(['products' => $products]);
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->search_term;

        $products = Product::query();
        $products->with('category');

        if ($searchTerm) {
            $products = $products->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('brand', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('category', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('name', 'LIKE', "%{$searchTerm}%");
                    });
            });
        } else {
            $products = $products->orderBy('id', 'DESC');
        }

        $products = $products->get()->map(function ($product) {
            $product->featured_url = Storage::url($product->featured);
            $product->data_sheet_url = Storage::url($product->data_sheet);
            return $product;
        });

        return response()->json(['products' => $products]);
    }

    public function filterByCategory(Request $request)
    {


        return view('category', compact('products'));
    }

}
