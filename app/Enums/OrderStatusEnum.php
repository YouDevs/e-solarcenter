<?php

namespace App\Enums;

abstract class OrderStatusEnum
{
    const PENDING_PAYMENT = 'pending_payment';
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const CANCELLED = 'cancelled';
}