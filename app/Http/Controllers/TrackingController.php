<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrackingOrderUpdate;
use Illuminate\Support\Facades\Log;

class TrackingController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Log::info("---handleWebhook----");
        $res = $request->json()->all();
        Log::info($res);

        $event = $res['event'] ?? 'EVENT_NOT_PROVIDED';
        $trackingNumber = $res['data']['number'] ?? 'NUMBER_NOT_PROVIDED';
        $latestStatus = $res['data']['track_info']['latest_status']['status'] ?? 'STATUS_NOT_PROVIDED';

        if($event == 'TRACKING_STOPPED') {
            return response()->json([
                'status' => 'info',
                'message' => "El tracking para este pedido: $trackingNumber ha sido detenido."
            ]);
        }

        $order = Order::where('tracking_number', $trackingNumber)->first();

        if(!$order) {
            Log::error("No se encontró el número de guía en nuestra base de datos.");
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontró el número de guía en nuestra base de datos.'
            ], 404);
        }

        $order->update(['delivery_status' => $status]);

        try {
            $order->update(['delivery_status' => $latestStatus]);

            Mail::to('carlos_develops@outlook.com')->send(new TrackingOrderUpdate($trackingNumber, $event, $latestStatus));

            return response()->json([
                'status' => 'success',
                'message' => 'Webhook procesado y correo enviado exitosamente.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error al procesar webhook o enviar correo: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error al procesar la actualización. Por favor, inténtelo de nuevo.'
            ], 500);
        }
    }
}
