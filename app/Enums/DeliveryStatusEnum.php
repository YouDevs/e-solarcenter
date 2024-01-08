<?php

namespace App\Enums;
use Illuminate\Support\Facades\Log;

abstract class DeliveryStatusEnum
{
    const NOT_FOUND = 'No encontrado';
    const TRANSIT = 'En trásito';
    const DELIVERED = 'Entregado';

    public static function getTranslatedStatus($status) {
        Log::info("status -> $status");
        switch ($status) {
            case 'notfound':
                return self::NOT_FOUND;
            case 'transit':
                return self::TRANSIT;
            case 'delivered':
                return self::DELIVERED;
            default:
                return 'N/A';
        }
    }

}