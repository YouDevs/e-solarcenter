<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\EstafetaApiService;
use App\Models\Location;
use Illuminate\Support\Facades\Log;

class EstafetaController extends Controller
{
    public function quoter(Request $request)
    {
        $estafetaService = new EstafetaApiService();

        $customerAddress = auth()->user()->customer->addresses->find($request->address);
        $location = Location::where('name', $request->location)->first();

        $originPostalCode = $location->postal_code;
        $destinationPostalCode = $customerAddress->postal_code;

        $data = [
            "Origin" => $originPostalCode,
            "Destination" => [$destinationPostalCode],
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
            Log::error($exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
