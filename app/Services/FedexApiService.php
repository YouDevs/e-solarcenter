<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FedexApiService
{
    private $baseUrl;
    private $apiKey;
    private $secretKey;
    protected $client;

    public function __construct() {
        $this->baseUrl = env('FEDEX_API_URL');
        $this->apiKey = env('FEDEX_API_KEY');
        $this->secretKey = env('FEDEX_SECRET_KEY');
        $this->client = new Client();
    }

    public function getAccessToken()
    {
        $url = "{$this->baseUrl}/oauth/token";

        try {
            $response = $this->client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->apiKey,
                    'client_secret' => $this->secretKey,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info($body);
            return $body['access_token'];

        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            Log::error('Error obteniendo el token de acceso: ' . $e->getMessage());
            return null;
        }
    }

}