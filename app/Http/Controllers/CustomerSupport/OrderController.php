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
            // $latest_status = null;

            // Obtiene el estado de entrega actualizado
            // if($order->tracking_number && $order->courier_code) {
            //     $latest_status = $this->trackingService->getLatestDeliveryStatus($order->tracking_number, $order->courier_code);
            // }

            // Actualiza el estado en la base de datos si es diferente
            // if (isset($latest_status) && ($order->delivery_status && $order->delivery_status !== $latest_status)) {
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

    public function edit(Order $order): View
    {
        $courierOptions = DeliveryServicesEnum::getCourierOptions();

        return view('customer_support.orders.edit', [
            'order' => $order,
            'courierOptions' => $courierOptions
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

            $result = $this->trackingService->createTracking($request->tracking_number, $request->courier_code);

            if($result) {

                // Después de crear el tracking hay que volver hacer una petición para obtener el status actual.
                $latestDeliveryStatus = $this->trackingService->getLatestDeliveryStatus($request->tracking_number, $request->courier_code);
                Log::info("latestDeliveryStatus: ");
                Log::info($latestDeliveryStatus);
                $order->update([
                    'courier_code' => $request->courier_code,
                    'tracking_number' => $request->tracking_number,
                    'delivery_status' => $latestDeliveryStatus['status'],
                ]);
                return $this->successRedirect('Número de guía guardado exitosamente');
            } else {
                return $this->successRedirect('Ups! algo salió mal... intenta de nuevo');
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
