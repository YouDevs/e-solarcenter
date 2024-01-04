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
use App\Enums\DeliveryStatusEnum;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();

        foreach ($orders as $order) {
            // Obtiene el estado de entrega actualizado
            // $latest_status = $this->getLatestDeliveryStatus($order->tracking_number, $order->courier_code);
            // Log::info("latest_status $latest_status");

            // Actualiza el estado en la base de datos si es diferente
            // if ($order->delivery_status !== $latest_status) {
            //     $order->update(['delivery_status' => $latest_status]);
            // }

            // Traduce el estado para mostrarlo en la vista
            $order->translated_delivery_status = DeliveryStatusEnum::getTranslatedStatus($order->delivery_status);
        }

        return view('customer_support.orders.index', ['orders' => $orders]);
    }

    public function edit(Order $order): View
    {
        $courier_codes = [
            DeliveryServicesEnum::TEST_CARRIER => DeliveryServicesEnum::TEST_CARRIER,
            DeliveryServicesEnum::DHL => DeliveryServicesEnum::DHL,
            DeliveryServicesEnum::ESTAFETA => DeliveryServicesEnum::ESTAFETA,
            DeliveryServicesEnum::FEDEX => DeliveryServicesEnum::FEDEX,
            DeliveryServicesEnum::PAQUETEXPRESS => DeliveryServicesEnum::PAQUETEXPRESS,
        ];

        return view('customer_support.orders.edit', [
            'order' => $order,
            'courier_codes' => $courier_codes
        ]);

    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        session()->flash('message', 'Status de la orden actualizado exitosamente');
        session()->flash('icon', 'success');

        return redirect()->back();
    }

    public function updateTrankingNumber(UpdateOrderGuideNumberRequest $request, Order $order)
    {

        try {
            $delivery_status = $this->createTracking($request->tracking_number, $request->courier_code);

            $order->update([
                'courier_code' => $request->courier_code,
                'tracking_number' => $request->tracking_number,
                'delivery_status' => $delivery_status
            ]);

            return $this->successRedirect('Número de guía guardado exitosamente');

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // errores del cliente, como un 400 Bad Request
            $response = $e->getResponse();
            $response_body_as_string = $response->getBody()->getContents();
            $status_code = $response->getStatusCode();
            Log::info($response_body_as_string);
            session()->flash('message', 'Hubo un problema con la solicitud: ' . $response_body_as_string);
            session()->flash('icon', 'error');
            return redirect()->back();

        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Aquí capturas errores del servidor, como un 500 Internal Server Error
            Log::info($e->getMessage());
            session()->flash('message', 'Hubo un problema con el servidor: ' . $e->getMessage());
            session()->flash('icon', 'error');
            return redirect()->back();

        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Capturas cualquier otro error de Guzzle
            Log::info($e->getMessage());
            session()->flash('message', 'Error al realizar la solicitud: ' . $e->getMessage());
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    private function createTracking($trackingNumber, $courierCode)
    {
        $client = new Client();
        $api_key = env("TRACKING_MORE_API_KEY");

        $response = $client->request('POST', 'https://api.trackingmore.com/v4/trackings/create', [
            'headers' => [
                'Tracking-Api-Key' => $api_key,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'tracking_number' => $trackingNumber,
                'courier_code' => $courierCode
            ]
        ]);

        $responseArray = json_decode($response->getBody(), true);
        return $responseArray['data']['delivery_status'];
    }

    private function successRedirect($message)
    {
        session()->flash('message', $message);
        session()->flash('icon', 'success');
        return redirect()->back();
    }

    private function errorRedirect($message)
    {
        session()->flash('message', $message);
        session()->flash('icon', 'error');
        return redirect()->back();
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
