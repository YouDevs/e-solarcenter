<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        // \Cart::clear();
        $cart_items = \Cart::getContent();
        // dd($cart_items);
        return view('cart', compact('cart_items'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->featuted,
                'brand' => $request->brand,
                'sku' => $request->sku,
            )
        ]);

        session()->flash('success', 'Product is Added to Cart Successfully !');

        // return redirect()->route('cart.list');
        return redirect()->route('index');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
