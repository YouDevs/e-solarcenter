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

    public function cusomter() : BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /*
    */
    public function getFullAddressAttribute()
    {
        $fullAddress = "$this->neighborhood $this->street C.P. $this->postal_code";
        return $fullAddress;
    }
}
