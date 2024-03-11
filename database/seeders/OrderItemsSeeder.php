<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén una orden y un producto de ejemplo o crea unos
        $order = Order::first();
        $product = Product::find(1);
        $product_2 = Product::find(2);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => $product->prices[0]->price
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product_2->id,
            'quantity' => 1,
            'price' => $product_2->prices[0]->price
        ]);
    }
}
