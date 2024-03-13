<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;

class CartController extends Controller
{
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
        dd($request->all());

        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'attributes' => array(
                'featured' => $request->featured,
                'brand' => $request->brand,
            )
        ]);

        session()->flash('success', 'Product is Added to Cart Successfully !');

        // return redirect()->route('cart.list');
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

    public function getProductStock(Request $request, $productId)
    {
        $product = Product::with(['stocks.location'])->findOrFail($productId);

        $stocks = $product->stocks->map(function ($stock) {
            return [
                'id' => $stock->location->id,
                'name' => $stock->location->name,
                'quantity' => $stock->quantity_available,
            ];
        });

        return response()->json([
            'stocks' => $stocks,
        ]);
    }

}
