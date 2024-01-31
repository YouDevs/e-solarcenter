<?php

namespace App\Enums;

abstract class OrderStatusEnum
{
    const PAYMENT_SUBMITTED = 'payment_submitted'; // Cuando el cliente ha realizado el pago pero aún no ha sido verificado
    const PENDING_PAYMENT = 'pending_payment'; // Cuando el cliente aún no ha realizado el pago
    const PENDING = 'pending'; // Puede ser usado para otros procesos pendientes
    const APPROVED = 'approved'; // Cuando la orden ha sido aprobada
    const CANCELLED = 'cancelled'; // Cuando la orden ha sido cancelada
}