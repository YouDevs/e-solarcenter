<?php

namespace App\Http\Controllers\CustomerSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Enums\OrderStatusEnum;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Requests\UpdateOrderGuideNumberRequest;
use App\Http\Requests\UpdateOrderInvoiceRequest;
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

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        session()->flash('message', 'Status de la orden actualizado exitosamente');
        session()->flash('icon', 'success');

        return redirect()->route('admin.orders.index');
    }

    public function updateGuideNumber(UpdateOrderGuideNumberRequest $request, Order $order)
    {
        $order->guide_number = $request->guide_number;
        $order->save();

        session()->flash('message', 'Número de guía de la orden actualizado exitosamente');
        session()->flash('icon', 'success');

        return redirect()->route('admin.orders.index');
    }

    public function updateInvoice(UpdateOrderInvoiceRequest $request, Order $order)
    {
        // $order->guide_number = $request->guide_number;
        // $order->save();

        // dd($request->hasFile('invoice'));

        // Subir la ficha técnica (PDF)
        if ($request->hasFile('invoice')) {
            $order->invoice = $request->file('invoice')->store('invoice', 'public');
            $order->save();
            session()->flash('message', 'La factura de la orden se actualizó exitosamente');
            session()->flash('icon', 'success');
        }


        return redirect()->route('admin.orders.index');
    }
}
