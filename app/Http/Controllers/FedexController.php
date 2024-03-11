<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FedexApiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FedexController extends Controller
{
    protected $fedexApi;
    protected $client;

    public function __construct(FedexApiService $fedexApi)
    {
        $this->fedexApi = $fedexApi;
        $this->client = new Client();
    }

    public function index()
    {
        $accessToken = $this->fedexApi->getAccessToken();

        if (!$accessToken) {
            Log::error('Error obteniendo el token de acceso para cotización de tarifas.');
            return null;
        }

        $shippingDetails = [
            "accountNumber" => [
                "value" => env('FEDEX_ACCOUNT_NUMBER')
            ],
            "requestedShipment" => [
                "shipper" => [
                    "address" => [
                        "postalCode" => "02300",
                        "countryCode" => "MX"
                    ]
                ],
                "recipient" => [
                    "address" => [
                        "postalCode" => "44290",
                        "countryCode" => "MX"
                    ]
                ],
                "pickupType" => "CONTACT_FEDEX_TO_SCHEDULE",
                // Si no incluyes la información de ServiceType, se arrojarán las tarifas para múltiples servicios
                "serviceType" => "FEDEX_EXPRESS_SAVER",
                "packagingType" => "YOUR_PACKAGING",
                // RateRequestTypes: para solicitar tarifas específicas, ya sean de LISTA o específicas de cuenta
                "rateRequestType" => [
                    "ACCOUNT"
                ],
                "requestedPackageLineItems" => [
                    [
                        "weight" => [
                            "units" => "KG",
                            "value" => 1
                        ],
                        // "dimensions" => [
                        //     "length" => 75,
                        //     "width" => 32,
                        //     "height" => 62,
                        //     "units" => "CM"
                        // ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->client->post("https://apis-sandbox.fedex.com/rate/v1/rates/quotes", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'X-locale' => 'es_MX',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($shippingDetails),
                'expect' => false, // Agrega esta línea
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info('Respuesta de cotización de tarifas:', $body);
            return $body;
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Verifica si la excepción tiene una respuesta
            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody(true);
                Log::error("Error completo de la solicitud: " . $responseBody);
            } else {
                Log::error('Error realizando la solicitud de cotización de tarifas: ' . $e->getMessage());
            }
            return null;
        }

    }
}
