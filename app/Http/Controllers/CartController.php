<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;
use App\Services\ProductStockService;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $productStockService;

    public function __construct(ProductStockService $productStockService)
    {
        $this->productStockService = $productStockService;
    }

    public function cartList()
    {
        // \Cart::clear();
        $cart_items = \Cart::getContent();
        $customer = auth()->user()->customer;

        if (is_null($customer)) {
            session()->flash('message', 'No tienes permiso para realizar esta acción.');
            session()->flash('icon', 'warning');
            return redirect()->back();
        }

        return view('cart', compact('cart_items'));
    }

    public function addToCart(Request $request)
    {
        $quantities = json_decode($request->quantities, true);

        foreach ($quantities as $location => $quantity) {
            if ( (int) $quantity !== 0 && (int) $quantity > 0) {
                $uniqueId = $request->id . '-' . $location;

                \Cart::add([
                    'id' => $uniqueId,
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => $quantity,
                    'attributes' => array(
                        'location' => $location,
                        'brand' => $request->brand,
                        'featured' => $request->featured,
                        'weight' => $request->weight,
                        'length' => $request->length,
                        'width' => $request->width,
                        'height' => $request->height,
                    )
                ]);
            }
        }

        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('index');
    }

    public function updateCart(Request $request)
    {
        //TODO: consultar el stock antes de permitirle actualizar el carrito para comprobar que la cantidad de existe.

        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        $new_subtotal = \Cart::getTotal();

        $new_subtotal_formatted = view('components.amount-formatter', ['amount' => $new_subtotal])->render();
        return response()->json(['newSubtotalFormatted' => $new_subtotal_formatted]);
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->item_id);
        session()->flash('message', 'Elemento eliminado del carrito exitosamente!');
        session()->flash('icon', 'success');

        return redirect()->back();
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function getProductStock(Request $request, Product $product)
    {
        $locationId = auth()->user()->customer->location_id;
        $stock = $this->productStockService->getProductStockForProduct($product, $locationId);
        return response()->json($stock);
    }

}
