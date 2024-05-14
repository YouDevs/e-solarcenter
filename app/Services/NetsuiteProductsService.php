<?php

namespace App\Services;
use App\Traits\OAuth1NetsuiteClientCreator;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class NetsuiteProductsService
{
    use OAuth1NetsuiteClientCreator;

    public function getNetsuiteClient()
    {
        $endpoint = config('netsuite.products_endpoint');

        $client = $this->createOAuth1Client(
            $endpoint,
            config('netsuite.consumer_key'),
            config('netsuite.consumer_secret'),
            config('netsuite.token_secret'),
            config('netsuite.token'),
            config('netsuite.realm')
        );
        return $client;
    }

    public function fetchProductsFromNetSuite($client, $page)
    {
        try {
            $response = $client->get('site/hosting/restlet.nl', [
                'query' => ['script' => '3627', 'deploy' => '1', 'page' => $page],
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
            ]);

            $products = json_decode($response->getBody(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('JSON decode error: ' . json_last_error_msg());
            }

            return $products;

        } catch (RequestException $e) {
            $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($responseBody['error']['code']) && $responseBody['error']['code'] === 'INVALID_PAGE_RANGE') {
                return []; // Retornar array vacío para detener la paginación
            }
            Log::error('Request to NetSuite failed: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error fetching products from NetSuite: ' . $e->getMessage());
            throw $e;
        }
    }
}