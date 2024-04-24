<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\EstafetaApiService;
use Illuminate\Support\Facades\Log;

class EstafetaController extends Controller
{
    public function quoter(Request $request)
    {

        $estafetaService = new EstafetaApiService();

        //TODO: Obtener el CP de la locación de Origen.
        //TODO: Obtener el CP de la dirección del cliente.

        // "location" => "GUADALAJARA"
        // "address" => "2"

        $data = [
            "Origin" => "45645",
            "Destination" => ["01000"],
            "PackagingType" => "Paquete",
            // "IsInsurance" => false,
            // "ItemValue" => 10,
            "Dimensions" => [
                "Weight" => 15,
                "Length" => 200,
                "Width" => 110,
                "Height" => 180,
            ]
        ];

        try {
            $quoteResponse = $estafetaService->getQuote($data);
            return response()->json($quoteResponse);
        } catch (\Exception $exception) {
            Log::info("Tronó...");
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
