<?php

namespace App\Http\Controllers\CustomerSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Enums\OrderStatusEnum;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::all();
        return view('customer_support.orders.index', ['orders' => $orders]);
    }

    public function edit(Order $order): View
    {
        return view('customer_support.orders.edit', [
            'order' => $order
        ]);
    }

    public function updateStatus(Order $order, Request $request)
    {
        $order->status = $request->status;
        $order->save();

        session()->flash('message', 'Status de la orden actualizado exitosamente');
        session()->flash('icon', 'success');

        return redirect()->route('admin.orders.index');
    }
}
