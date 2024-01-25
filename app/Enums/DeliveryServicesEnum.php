<?php

namespace App\Enums;

abstract class DeliveryServicesEnum
{
    // const TEST_CARRIER = "test-carrier";
    const DHL = 'DHL';
    const ESTAFETA = 'Estafeta';
    const FEDEX = 'FedEx';
    const PAQUETEXPRESS = 'Paquetexpress';

    private static $courierCodes = [
        self::DHL => '100001',
        self::ESTAFETA => '100139',
        self::FEDEX => '100003',
        self::PAQUETEXPRESS => '100147',
    ];

    public static function getCourierOptions()
    {
        $options = [];
        foreach (self::$courierCodes as $name => $code) {
            $options[$code] = $name;
        }
        return $options;
    }

}