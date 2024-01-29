<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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
    public function index()
    {
        // session()->flush();
        $products = Product::query();
        $products->orderBy('id', 'DESC');

        $products = $products->get()->map(function ($product) {
            $product->featured_url = Storage::url($product->featured);
            $product->data_sheet_url = $product->data_sheet ? Storage::url($product->data_sheet): null;
            return $product;
        });

        return view('index', compact('products'));
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
            dd($product->data_sheet_url);
            return $product;
        });

        return response()->json(['products' => $products]);
    }

    public function filterByCategory(Request $request)
    {


        return view('category', compact('products'));
    }

}
