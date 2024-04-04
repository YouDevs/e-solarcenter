<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Enums\BrandsEnum;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CustomerContactRequest;

use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerContact;
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
            $categoryId = $request->input('category_id');
            $products->where('category_id', $categoryId);
        }

        // Filtra los productos por marca si se proporciona brand
        if ($request->has('brand')) { // Corregido para usar 'brand' en lugar de '$brand'
            $brand = $request->input('brand'); // Corregido para obtener correctamente el valor de 'brand'
            $products->where('brand', $brand);
        }

        $products->orderBy('id', 'DESC');

        $products = $products->get()->map(function ($product) {
            $product->featured_url = Storage::url($product->featured);
            $product->data_sheet_url = $product->data_sheet ? Storage::url($product->data_sheet): null;
            return $product;
        });

        return view('index', compact('request', 'products'));
    }

    public function productByFilter(Request $request, Product $product)
    {
        // Obtener productos de la misma marca y categoría excluyendo el producto actual
        $relatedByBrand = Product::where('brand', $product->brand)
        ->where('id', '!=', $product->id)
        ->take(5)
        ->get();

        $relatedByCategory = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(5)
        ->get();

        // Combina las colecciones y elimina duplicados
        $relatedProducts = $relatedByBrand->merge($relatedByCategory)->unique('id');
        // Mezcla los productos aleatoriamente
        $relatedProducts = $relatedProducts->shuffle();

        return view('product', compact('product', 'relatedProducts'));

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

    public function aboutUs()
    {
        return view('about_us.index');
    }

    public function branches()
    {
        return view('about_us.branches');
    }

    public function contact()
    {
        return view('about_us.contact');
    }

    public function sendContact(CustomerContactRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message_body = $request->message;

        try {
            Mail::to( $email )->send( new CustomerContact( $name, $email, $phone, $subject, $message_body ) );
            session()->flash('message', 'Tu mensaje ha sido enviado con éxito!');
            session()->flash('icon', 'success');
        } catch (\Exception $e) {
            session()->flash('message', 'Hubo un error al enviar tu mensaje. Por favor, intenta de nuevo más tarde.');
            session()->flash('icon', 'error');
            Log::error('Error al encolar correo: ' . $e->getMessage());
        }

        return redirect()->back();
    }

}
