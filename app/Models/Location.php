<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'netsuite_id',
        'netsuite_name',
        'street',
        'postal_code',
        'neighborhood',
        'country',
        'state',
        'city',
    ];

}
