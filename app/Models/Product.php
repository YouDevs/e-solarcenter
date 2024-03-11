<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'brand',
        'category_id',
        'netsuite_item',
        'netsuite_item_txt',
        'data_sheet',
        'slug'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ------ Gestión del precio ------
    */
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function getDefaultPriceAttribute()
    {
        $defaultPrice = $this->prices->where('level', 'Lista 1')->first();
        return $defaultPrice ? $defaultPrice->price : null;
    }

    /**
     * ------ Gestión del stock ------
    */
    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function getTotalAvailableQuantityAttribute()
    {
        return $this->stocks->sum('quantity_available');
    }
}
