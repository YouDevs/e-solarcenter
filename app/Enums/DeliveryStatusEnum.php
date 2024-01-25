<?php

namespace App\Enums;
use Illuminate\Support\Facades\Log;

abstract class DeliveryStatusEnum
{
    const NOT_FOUND = 'No encontrado';
    const INFO_RECEIVED = 'Info. Recibida';
    const IN_TRANSIT = 'En tránsito';
    const EXPIRED = 'El paquete ha estado en tránsito durante mucho tiempo.';
    const AVAILABLE_FOR_PICKUP = 'Disponible para recoger';
    const OUT_FOR_DELIVERY = 'El paquete listo para entrega';
    const DELIVERY_FAILURE = 'Se intentó entregar el paquete pero no se logró.';
    const DELIVERED = 'Paquete entregado y firmado por la destinataria.';
    const EXCEPTION = 'El paquete puede ser devuelto.';

    public static function getTranslatedStatus($status)
    {
        switch ($status) {
            case 'NotFound':
                return self::NOT_FOUND;
            case 'InfoReceived':
                return self::INFO_RECEIVED;
            case 'InTransit':
                return self::IN_TRANSIT;
            case 'Expired':
                return self::EXPIRED;
            case 'AvailableForPickup':
                return self::AVAILABLE_FOR_PICKUP;
            case 'OutForDelivery':
                return self::OUT_FOR_DELIVERY;
            case 'Delivered':
                return self::DELIVERED;
            case 'Exception':
                return self::EXCEPTION;
            default:
                return 'N/A';
        }
    }

}