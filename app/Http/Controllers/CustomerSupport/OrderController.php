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
use App\Enums\DeliveryServicesEnum;
use App\Enums\DeliveryStatusEnum;
use GuzzleHttp\Client;
use App\Services\TrackingService;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDelivered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $trackingService;

    public function __construct(TrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function index(): View
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();

        foreach ($orders as $order) {
            // // Obtiene el estado de entrega actualizado
            // if($order->tracking_number && $order->courier_code) {
            //     $latest_status = $this->trackingService->getLatestDeliveryStatus($order->tracking_number, $order->courier_code);
            // }

            // // Actualiza el estado en la base de datos si es diferente
            // if ($order->delivery_status && $order->delivery_status !== $latest_status) {
            //     $order->update(['delivery_status' => $latest_status]);

            //     //TODO: enviar correo desde un cron-job.
            //     if( $latest_status == 'delivered' ) {
            //         Mail::to( $order->customer->user->email )->send(new OrderDelivered($order) );

            //         //TODO: enviar correo también al operador:
            //         // Mail::to( 'carlos.hernandez@solar-center.mx' )->send( new OrderDeliveredAdmin($order) );
            //     }
            // }

            // Traduce el estado para mostrarlo en la vista
            $order->translated_delivery_status = DeliveryStatusEnum::getTranslatedStatus($order->delivery_status);
        }

        return view('customer_support.orders.index', ['orders' => $orders]);
    }

    // En tu TrackingController
    public function handleWebhook(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        Log::info('Webhook received from 17TRACK:', $data);

        // Procesa la actualización aquí. Por ejemplo, actualizar el estado en tu base de datos.
        if (isset($data['event']) && $data['event'] == 'TRACKING_UPDATED') {
            foreach ($data['data']['accepted'] as $tracking) {
                $trackingNumber = $tracking['number'];
                $updatedStatus = $tracking['status']; // Asegúrate de que 'status' es la clave correcta.

                Log::info("trackingNumber: $trackingNumber");
                Log::info("updatedStatus: $updatedStatus");

                // Aquí actualizas el estado de tu pedido en la base de datos.
                // Asegúrate de tener una lógica para encontrar y actualizar el pedido correspondiente.
        }
    }

    return response()->json(['message' => 'Webhook received and processed']);
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
            $delivery_status = $this->createTracking($request->tracking_number);

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
            session()->flash('message', 'Error: Intenta de nuevo cuando estes sobrio.');
            session()->flash('icon', 'error');
            return redirect()->back();

        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Aquí capturas errores del servidor, como un 500 Internal Server Error
            Log::info($e->getMessage());
            session()->flash('message', 'Error: mejor consulta con el genio que programó esto! ');
            session()->flash('icon', 'error');
            return redirect()->back();

        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Capturas cualquier otro error de Guzzle
            Log::info($e->getMessage());
            session()->flash('message', 'Error: Algo falló con éxito!');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    private function createTracking($trackingNumber)
    {
        $client = new Client();
        $api_key = env("17TRACK_API_KEY");

        try {
            $response = $client->request('POST', 'https://api.17track.net/track/v2.2/register', [
                'headers' => [
                    '17token' => $api_key,
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    [
                        'number' => $trackingNumber
                        // No necesitas 'courier_code' aquí ya que 17TRACK detecta automáticamente el transportista.
                    ]
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $responseArray = json_decode($response->getBody(), true);
                Log::info("responseArray: ");
                Log::info($responseArray);
                // Aquí debes revisar la documentación de 17TRACK para entender cómo interpretar la respuesta.
                // Por ejemplo, si la respuesta incluye un estado de aceptación o rechazo de los números de seguimiento.
                return $responseArray['data']['accepted'][0]['number']; // Esto es un ejemplo, ajusta según la respuesta real.
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error("Error al crear el seguimiento: " . $e->getMessage());
            return 'unknown';
        }
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
