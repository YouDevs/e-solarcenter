<?php

namespace App\Services\Contracts;

interface ShippingServiceInterface
{
    public function getAccessToken();
    public function getQuote($data);
}