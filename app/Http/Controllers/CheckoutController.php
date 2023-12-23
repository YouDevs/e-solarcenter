<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function details()
    {
        $cart_items = \Cart::getContent();

        return view('checkout-details', compact('cart_items'));
    }

    public function shipping()
    {
        $cart_items = \Cart::getContent();
        return view('checkout-shipping', compact('cart_items'));
    }

    public function payment()
    {
        $cart_items = \Cart::getContent();

        $customer = auth()->user()->customer;
        $last_order = Order::where('customer_id', $customer->id)->orderBy('created_at','DESC')->first();

        $last_order_id = !is_null($last_order) ? $last_order->id: 1;
        $payment_concept = $last_order->generatePaymentConcept($last_order_id);

        return view('checkout-payment', compact('cart_items', 'payment_concept'));
    }
}
