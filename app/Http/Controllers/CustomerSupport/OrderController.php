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
use Illuminate\Support\Facades\Storage;
use App\Enums\DeliveryServicesEnum;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('customer_support.orders.index', ['orders' => $orders]);
    }

    public function edit(Order $order): View
    {
        $delivery_services = [
            DeliveryServicesEnum::DHL => DeliveryServicesEnum::DHL,
            DeliveryServicesEnum::ESTAFETA => DeliveryServicesEnum::ESTAFETA,
            DeliveryServicesEnum::FEDEX => DeliveryServicesEnum::FEDEX,
            DeliveryServicesEnum::PAQUETEXPRESS => DeliveryServicesEnum::PAQUETEXPRESS,
        ];

        return view('customer_support.orders.edit', [
            'order' => $order,
            'delivery_services' => $delivery_services
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

        Log::info( $request->all() );

        $client = new Client();

        $api_key = env("TRACKING_MORE_API_KEY");
        Log::info("api_key: $api_key");

        $response = $client->request('POST', 'https://api.trackingmore.com/v4/trackings/create', [
            'headers' => [
                'Tracking-Api-Key' => $api_key,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'tracking_number' =>  $request->guide_number, //$trackingNumber,
                'courier_code' =>  $request->delivery_service //$courierCode
            ]
        ]);

        Log::info($response->getBody());

        return json_decode($response->getBody(), true);

        // $order->delivery_service = $request->delivery_service;
        // $order->guide_number = $request->guide_number;
        // $order->save();

        // session()->flash('message', 'Número de guía de la orden actualizado exitosamente');
        // session()->flash('icon', 'success');

        // return redirect()->route('admin.orders.index');
    }

    public function updateInvoice(UpdateOrderInvoiceRequest $request, Order $order)
    {

        if ($request->hasFile('invoice')) {

            // Verificar si ya existe un archivo de factura y eliminarlo
            if ($order->invoice && Storage::disk('public')->exists($order->invoice)) {
                Storage::disk('public')->delete($order->invoice);
            }

            $order->invoice = $request->file('invoice')->store('invoice', 'public');
            $order->save();
            session()->flash('message', 'La factura de la orden se actualizó exitosamente');
            session()->flash('icon', 'success');
        }


        return redirect()->route('admin.orders.index');
    }
}
