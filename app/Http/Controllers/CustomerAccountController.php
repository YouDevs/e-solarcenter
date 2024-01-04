<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\DeliveryStatusEnum;

class CustomerAccountController extends Controller
{
    public function accountOrders()
    {
        $customer = Auth::user()->customer;

        $orders = $customer->orders;

        foreach ($orders as $order) {
            $order->translated_delivery_status = DeliveryStatusEnum::getTranslatedStatus($order->delivery_status);
        }

        return view('customer.account-orders', [
            'customer' => $customer,
            'orders' => $orders,
        ]);
    }
}
