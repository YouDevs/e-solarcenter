<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\EstafetaApiService;
use Illuminate\Support\Facades\Log;

class EstafetaController extends Controller
{
    public function quoter()
    {
        $estafetaService = new EstafetaApiService();

        $data = [
            "Origin" => "62320",
            "Destination" => ["01000"],
            "PackagingType" => "Paquete",
            "IsInsurance" => false,
            "ItemValue" => 10,
            "Dimensions" => [
                "Weight" => 10, // peso
                "Length" => 10, // largo
                "Width" => 10, // ancho
                "Height" => 10, // alto
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
