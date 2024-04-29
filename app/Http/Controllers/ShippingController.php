<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EstafetaApiService;
use App\Models\Location;
use App\Services\ShippingServiceFactory;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{

    protected $shippingServiceFactory;

    public function __construct(ShippingServiceFactory $factory)
    {
        $this->shippingServiceFactory = $factory;
    }

    public function quoter(Request $request)
    {
        $carrier = 'estafeta';
        $shippingService = $this->shippingServiceFactory->make($carrier);

        $destinationPostalCode = auth()->user()->customer->addresses->find($request->address)->postal_code;
        $customerLocationPostalCode = auth()->user()->customer->location->postal_code;
        $originPostalCode = $request->location === 'Nacional' ? $this->getNationalOriginPostalCode($customerLocationPostalCode) : $this->getLocalOriginPostalCode($request->location);

        $data = $this->prepareQuotationData($originPostalCode, $destinationPostalCode);

        return $request->location === 'Nacional' ?
            $this->getCheapestNationalQuote($shippingService, $data) :
            $this->getLocalQuote($shippingService, $data);
    }

    protected function getNationalOriginPostalCode($excludePostalCode)
    {
        $query = Location::query();

        if ($excludePostalCode) {
            $query->where('postal_code', '!=', $excludePostalCode);
        }

        return $query->pluck('postal_code')->all();
    }

    protected function getLocalOriginPostalCode($locationName)
    {
        // Obtiene el código postal de la locación local
        return Location::where('name', $locationName)->first()->postal_code;
    }

    protected function prepareQuotationData($origin, $destination)
    {
        return [
            "Origin" => $origin,
            "Destination" => [$destination],
            "PackagingType" => "Paquete",
            "Dimensions" => [
                "Weight" => 15,
                "Length" => 200,
                "Width" => 110,
                "Height" => 180,
            ]
        ];
    }

    protected function getLocalQuote($shippingService, $data)
    {
        try {
            return response()->json($shippingService->getQuote($data));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    protected function getCheapestNationalQuote($shippingService, $data)
    {
        $cheapestQuote = null;

        foreach ($data['Origin'] as $originPostalCode) {
            Log::info($data['Origin']);
            $data['Origin'] = $originPostalCode; // Reemplazar el origen en los datos de cotización
            try {
                $quoteResponse = $shippingService->getQuote($data);
                if ($this->isCheaperQuote($quoteResponse, $cheapestQuote)) {
                    $cheapestQuote = $quoteResponse;
                }
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return $cheapestQuote ?
            response()->json($cheapestQuote) :
            response()->json(['error' => 'No se pudo obtener una cotización económica'], 500);
    }

    protected function isCheaperQuote($quoteResponse, $cheapestQuote)
    {
        return $quoteResponse && (is_null($cheapestQuote) || $quoteResponse['Quotation'][0]['Service'][0]['TotalAmount'] < $cheapestQuote['Quotation'][0]['Service'][0]['TotalAmount']);
    }

}
