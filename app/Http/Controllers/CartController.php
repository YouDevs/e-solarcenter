<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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

        $last_order = Order::where('customer_id', $customer->id)->orderBy('created_at','DESC')->first();

        $last_order_id = !is_null($last_order) ? $last_order->id: 1;
        $payment_concept = $last_order->generatePaymentConcept($last_order_id);

        return view('cart', compact('cart_items', 'payment_concept'));
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
                'featured' => $request->featured,
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
        \Cart::remove($request->item_id);
        session()->flash('message', 'Elemento eliminado del carrito exitosamente!');
        session()->flash('icon', 'success');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
