<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

trait OAuth1ClientCreator
{
    public function createOAuth1Client($endpoint, $consumer_key, $consumer_secret, $token_secret, $token, $realm)
    {
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
    }
}