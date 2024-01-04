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

        return redirect()->route('admin.orders.index');
    }

    public function updateGuideNumber(UpdateOrderGuideNumberRequest $request, Order $order)
    {
        // Log::info( $request->all() );
        $client = new Client();
        $api_key = env("TRACKING_MORE_API_KEY");

        // delivery_status
        // return json_decode($response->getBody(), true);
        try {
            $response = $client->request('POST', 'https://api.trackingmore.com/v4/trackings/create', [
                'headers' => [
                    'Tracking-Api-Key' => $api_key,
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'tracking_number' => $request->tracking_number,
                    'courier_code' => $request->courier_code
                ]
            ]);

            // Si necesitas el código de estado o cualquier otra información
            $status_code = $response->getStatusCode();
            Log::info($status_code);

            if($status_code == 200) {
                $order->courier_code = $request->courier_code;
                $order->tracking_number = $request->tracking_number;
                $order->save();

                session()->flash('message', 'Número de guía guardado exitosamente');
                session()->flash('icon', 'success');

                return redirect()->route('admin.orders.index');
            }


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // errores del cliente, como un 400 Bad Request
            $response = $e->getResponse();
            $response_body_as_string = $response->getBody()->getContents();
            $status_code = $response->getStatusCode();
            Log::info($response_body_as_string);
            session()->flash('message', 'Hubo un problema con la solicitud: ' . $response_body_as_string);
            session()->flash('icon', 'error');
            return redirect()->route('admin.orders.index');

        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Aquí capturas errores del servidor, como un 500 Internal Server Error
            Log::info($e->getMessage());
            session()->flash('message', 'Hubo un problema con el servidor: ' . $e->getMessage());
            session()->flash('icon', 'error');
            return redirect()->route('admin.orders.index');

        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Capturas cualquier otro error de Guzzle
            Log::info($e->getMessage());
            session()->flash('message', 'Error al realizar la solicitud: ' . $e->getMessage());
            session()->flash('icon', 'error');
            return redirect()->route('admin.orders.index');
        }




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
