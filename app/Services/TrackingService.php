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
        $this->api_key = env("TRACKING_MORE_API_KEY");
    }

    public function getLatestDeliveryStatus($tracking_number, $courier_code)
    {
        try {
            $response = $this->client->request("GET", "https://api.trackingmore.com/v4/trackings/get?tracking_numbers=$tracking_number", [
                'headers' => [
                    'Tracking-Api-Key' => $this->api_key,
                    'Content-Type' => 'application/json'
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $response_array = json_decode($response->getBody(), true);
                return $response_array['data'][0]['delivery_status'];
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error("Error al obtener el estado de entrega: " . $e->getMessage());
            return 'unknown';
        }
    }

}
