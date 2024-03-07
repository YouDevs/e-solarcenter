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
        $this->apiKey = config("services.tracking.key");
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
            Log::info("17track register:", $responseArray);

            if ($response->getStatusCode() === 200 && isset($responseArray['code']) && $responseArray['code'] === 0) {
                return ['success' => true, 'message' => 'Tracking registrado exitosamente.'];
            }

            return ['success' => false, 'message' => 'La API de 17track retornó un error o una respuesta inesperada.', 'details' => $responseArray];

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error("Error al crear el seguimiento: " . $e->getMessage());
            return ['success' => false, 'message' => 'Ocurrió un error de cliente al intentar registrar el tracking.', 'error' => $e->getMessage()];
        } catch (\Exception $e) {
            Log::error("Error general al crear el seguimiento: " . $e->getMessage());
            return ['success' => false, 'message' => 'Ocurrió un error general al intentar registrar el tracking.', 'error' => $e->getMessage()];
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
            Log::info("17track gettrackinfo:", ['res' => $responseArray]);

            // Asumiendo que el código de respuesta es 0 para éxito
            if ($responseArray['code'] === 0 && !empty($responseArray['data']['accepted'])) {
                $accepted = $responseArray['data']['accepted'][0]; // Asumiendo que trabajamos con el primer resultado aceptado
                $latestStatus = $accepted['track_info']['latest_status']['status'] ?? 'STATUS_NOT_PROVIDED';
                $latestEvent = $accepted['track_info']['latest_event']['description'] ?? 'EVENT_NOT_PROVIDED';

                return ['status' => $latestStatus, 'event' => $latestEvent];

            } else {
                // Manejar casos en que no se acepta el número de seguimiento o hay errores
                Log::error("Tracking number rejected or error received.", ['response' => $responseArray]);
                return null;
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error("Error al obtener el estado de entrega: " . $e->getMessage());
            return null;
        }
    }

}
