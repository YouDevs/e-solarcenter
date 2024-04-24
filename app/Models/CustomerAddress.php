<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'is_default',
        'street',
        'postal_code',
        'neighborhood',
        'country',
        'state',
        'city',
    ];
}
