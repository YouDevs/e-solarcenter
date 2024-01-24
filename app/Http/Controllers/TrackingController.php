<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class TrackingController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Log::info("---handleWebhook----");
        $data = $request->json()->all();

        Log::info($data);

        // Verifica directamente los datos sin buscar una clave 'accepted'
        $trackingNumber = $data['data']['number'];
        // Accede al estado desde la ruta correcta dentro del array
        $status = $data['data']['track_info']['latest_status']['status'] ?? 'unknown'; // Usa el operador de fusión de null por si acaso

        $order = Order::where('tracking_number', $trackingNumber)->first();
        if ($order) {
            // Actualiza el estado en la base de datos
            $order->update(['delivery_status' => $status]);

            // TODO: agregar lógica adicional, como enviar correos electrónicos de notificación
        }

        return response()->json(['message' => 'Webhook received successfully']);
    }
}
