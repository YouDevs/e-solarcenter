<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Support\Facades\Log;

trait OAuth1NetsuiteClientCreator
{
    public function createOAuth1Client($endpoint, $consumer_key, $consumer_secret, $token_secret, $token, $realm)
    {
        if (empty($endpoint) || empty($consumer_key) || empty($consumer_secret) || empty($token_secret) || empty($token) || empty($realm)) {
            Log::error('Missing required parameters for creating OAuth1 client.');
            throw new \InvalidArgumentException('Missing required parameters for creating OAuth1 client.');
        }

        try {
            $handler = new CurlHandler();
            $stack = HandlerStack::create($handler);

            $middleware = new Oauth1([
                'consumer_key'    => $consumer_key,
                'consumer_secret' => $consumer_secret,
                'token_secret'    => $token_secret,
                'token'           => $token,
                'version'         => '1.0',
                'realm'           => $realm,
                'signature_method' => Oauth1::SIGNATURE_METHOD_HMACSHA256
            ]);

            $stack->push($middleware);

            return new Client([
                'base_uri' => $endpoint,
                'handler' => $stack,
                'auth' => 'oauth'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to create OAuth1 client: ' . $e->getMessage());
            throw $e;
        }
    }
}