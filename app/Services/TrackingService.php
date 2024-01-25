<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Enums\DeliveryServicesEnum;

class TrackingService
{
    protected $client;
    protected $apikey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env("17TRACK_API_KEY");
    }

    public function createTracking($trackingNumber, $courierCode)
    {
        try {
            $response = $this->client->request('POST', 'https://api.17track.net/track/v2.2/register', [
                'headers' => [
                    '17token' => $this->apiKey,
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    [
                        'number' => $trackingNumber,
                        'carrier' => $courierCode
                    ]
                ]
            ]);

            $responseArray = json_decode($response->getBody(), true);

            if ($response->getStatusCode() === 200 && isset($responseArray['code']) && $responseArray['code'] === 0) {
                return true;
            }

            return false;

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error("Error al crear el seguimiento: " . $e->getMessage());
            return 'unknown';
        }
    }

    public function getLatestDeliveryStatus($trackingNumber, $courierCode)
    {
        try {
            $response = $this->client->request('POST', 'https://api.17track.net/track/v2.2/gettrackinfo', [
                'headers' => [
                    '17token' => $this->apiKey,
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    [
                        'number' => $trackingNumber,
                        'carrier' => $courierCode
                    ]
                ]
            ]);

            $responseArray = json_decode($response->getBody(), true);
            Log::info("responseArray::::: ");
            Log::info($responseArray);

            // Asumiendo que el código de respuesta es 0 para éxito
            if ($response->getStatusCode() === 200 && $responseArray['code'] === 0) {
                $latestStatus = $responseArray['data']['accepted'][0]['track_info']['latest_status']['status'] ?? null;
                $latestEvent = $responseArray['data']['accepted'][0]['track_info']['latest_event']['description'] ?? null;

                if ($latestStatus) {
                    return ['status' => $latestStatus, 'event' => $latestEvent];
                } else {
                    return null;
                }
            } else {
                Log::error("Respuesta no exitosa al obtener el estado de entrega.");
                return null;
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error("Error al obtener el estado de entrega: " . $e->getMessage());
            return null;
        }
    }

}
