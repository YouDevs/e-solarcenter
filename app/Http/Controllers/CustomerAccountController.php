<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\DeliveryStatusEnum;
use App\Services\TrackingService;
use Illuminate\Support\Facades\Log;

class CustomerAccountController extends Controller
{
    protected $trackingService;

    public function __construct(TrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function accountOrders()
    {
        $customer = Auth::user()->customer;

        $orders = $customer->orders()->orderBy('id', 'desc')->get();

        foreach ($orders as $order) {
            // Obtiene el estado de entrega actualizado
            if($order->tracking_number && $order->courier_code) {
                $latest_status = $this->trackingService->getLatestDeliveryStatus($order->tracking_number, $order->courier_code);
            }

            // Actualiza el estado en la base de datos si es diferente
            if ($order->delivery_status && $order->delivery_status !== $latest_status) {
                $order->update(['delivery_status' => $latest_status]);
            }

            // Traduce el estado para mostrarlo en la vista
            $order->translated_delivery_status = DeliveryStatusEnum::getTranslatedStatus($order->delivery_status);
        }

        return view('customer.account-orders', [
            'customer' => $customer,
            'orders' => $orders,
        ]);
    }

}
