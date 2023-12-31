<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total',
        'status',
        'courier_code',
        'delivery_status',
        'tracking_number',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    public function generatePaymentConcept($last_order_id)
    {
        $folio = sprintf('%04d', $last_order_id);

        // Divide el nombre de la empresa en palabras y toma la primera palabra
        $company_words = explode(' ', $this->customer->company_name);
        $first_word_of_company_name = $company_words[0];

        return 'Orden ' . $folio .' '. $first_word_of_company_name .' '. date('Y');
    }

    public function folio()
    {
        $folio = sprintf('%04d', $this->id);
        return $folio;
    }

}
