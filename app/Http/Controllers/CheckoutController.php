<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
