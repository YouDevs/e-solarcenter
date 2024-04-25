<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Services\Contracts\ShippingServiceInterface;
use Illuminate\Support\Facades\Log;

class EstafetaApiService implements ShippingServiceInterface
{
    protected $client;
    protected $apiKey;
    protected $secret;
    protected $urlToken;
    protected $tokenId;

    public function __construct()
    {
        $this->client = new Client();
        $this->clientId = config('services.estafeta.client_id');
        $this->clientSecret = config('services.estafeta.client_secret');
        $this->urlToken = config('services.estafeta.token_url');
        $this->type = config('services.estafeta.type');
        $this->scope = config('services.estafeta.scope');
    }

    public function getAccessToken()
    {
        try {

            $this->client = new Client([
                'base_uri' => $this->urlToken,
                'http_errors' => false
            ]);

            $formParams = [
                'grant_type'    => $this->type,
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope'         => $this->scope,
            ];

            $response = $this->client->post($this->urlToken, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => $formParams,
            ]);

            $statusCode = $response->getStatusCode();

            $body = json_decode($response->getBody(), true);

            if ($statusCode == 200 && isset($body['access_token'])) {
                return $body['access_token'];
            } else {
                Log::error("No access token in response", ['response' => $tokenData]);
                return null;
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                Log::error("RequestException: " . $e->getMessage(), ['response' => $responseBody]);
            } else {
                Log::error("RequestException: " . $e->getMessage());
            }
        } catch (ConnectException $e) {
            Log::error("ConnectException: No se pudo establecer conexión con el host.", ['error' => $e->getMessage()]);
        } catch (GuzzleException $e) {
            Log::error("GuzzleException: " . $e->getMessage());
        }
    }

    public function getQuote($data)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return ['error' => 'Failed to authenticate with Estafeta'];
        }

        try {
            $response = $this->client->post('https://wscotizadorqa.estafeta.com/Cotizacion/rest/Cotizador/Cotizacion', [
                'debug' => false,
                'headers' => [
                    'apiKey' => $this->clientId,
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                    // 'Customer' => "0000000",
                    // 'Sales_organization' => "112",
                ],
                'json' => $data
            ]);
            $statusCode = $response->getStatusCode();
            $result = json_decode($response->getBody(), true);
            return $result;
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            $responseBody = $response ? $response->getBody()->getContents() : 'null';
            Log::error("Failed to get quote: " . $e->getMessage(), ['responseBody' => $responseBody]);
            return ['error' => 'Failed to get quote', 'responseBody' => $responseBody];
        }
    }
}