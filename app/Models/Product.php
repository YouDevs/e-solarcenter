<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedPrice()
    {
        $formattedPrice = number_format($this->price, 2);

        list($priceWhole, $priceDecimal) = explode('.', $formattedPrice);

        return ['whole' => $priceWhole, 'decimal' => $priceDecimal];
    }
}
