<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAccountController extends Controller
{
    public function accountOrders()
    {
        $customer = Auth::user()->customer;

        $orders = $customer->orders;

        return view('customer.account-orders', [
            'customer' => $customer,
            'orders' => $orders,
        ]);
    }
}
