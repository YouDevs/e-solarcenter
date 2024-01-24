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
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->search_term;

        if($searchTerm) {
            $products = Product::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('brand', 'LIKE', "%{$searchTerm}%")
            ->get()
            ->map(function ($product) {
                $product->featured_url = Storage::url($product->featured);
                return $product;
            });
        } else {
            $products = Products::orderBy('id', 'DESC')->get();
        }

        return response()->json(['products' => $products]);
    }

}
