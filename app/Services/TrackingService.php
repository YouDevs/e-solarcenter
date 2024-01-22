<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TrackingService
{
    protected $client;
    protected $api_key;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->api_key = env("17TRACK_API_KEY");
    }

    public function getLatestDeliveryStatus($tracking_number)
    {
        try {
            $response = $this->client->request("GET", "https://api.17track.net/track/v2/get?num=$tracking_number", [
                'headers' => [
                    '17token' => $this->api_key,
                    'Content-Type' => 'application/json'
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $response_array = json_decode($response->getBody(), true);

                Log::info($response_array);

                // Debes revisar la documentación de 17TRACK para entender la estructura exacta de la respuesta
                // y ajustar la siguiente línea acorde a ello.
                return $response_array['data']['status']; // Ajusta esto según la estructura de respuesta de 17TRACK
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error("Error al obtener el estado de entrega: " . $e->getMessage());
            return 'unknown';
        }
    }

}
