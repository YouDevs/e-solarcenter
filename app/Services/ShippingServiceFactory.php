<?php

namespace App\Services;

use App\Services\Contracts\ShippingServiceInterface;

class ShippingServiceFactory
{
    public function make($carrier): ShippingServiceInterface
    {
        switch ($carrier) {
            case 'estafeta':
                return new EstafetaApiService();
            case 'fedex':
                return new FedExApiService();
            default:
                throw new \InvalidArgumentException("Invalid carrier type: {$carrier}");
        }
    }
}