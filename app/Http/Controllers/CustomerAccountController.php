<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\DeliveryStatusEnum;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CustomerAccountController extends Controller
{
    public function accountOrders()
    {
        $customer = Auth::user()->customer;

        $orders = $customer->orders;

        foreach ($orders as $order) {
            // Obtiene el estado de entrega actualizado
            $latest_status = $this->getLatestDeliveryStatus($order->tracking_number, $order->courier_code);
            Log::info("latest_status $latest_status");

            // Actualiza el estado en la base de datos si es diferente
            if ($order->delivery_status !== $latest_status) {
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

    private function getLatestDeliveryStatus($tracking_number, $courier_code)
    {
        $client = new Client();
        $api_key = env("TRACKING_MORE_API_KEY");

        try {
            $response = $client->request("GET", "https://api.trackingmore.com/v4/trackings/get?tracking_numbers=$tracking_number", [
                'headers' => [
                    'Tracking-Api-Key' => $api_key,
                    'Content-Type' => 'application/json'
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $response_array = json_decode($response->getBody(), true);
                return $response_array['data'][0]['delivery_status'];
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Manejar el error cuando el número de seguimiento no existe
            // Puedes decidir devolver un estado por defecto o manejar el error de otra manera
            Log::error("Error al obtener el estado de entrega: " . $e->getMessage());
            return 'Estado desconocido'; // O manejar de otra manera
        }
    }

}
