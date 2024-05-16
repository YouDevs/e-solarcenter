<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAssitanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'customer_name',
        'customer_email',
        'message',
    ];
}
