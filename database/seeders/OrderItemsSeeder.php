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
        $order = Order::first(); // Asegúrate de que haya al menos una orden en la base de datos
        $product = Product::find(1);
        $product_2 = Product::find(2);

        OrderItem::create([
            'order_id' => $order->id, // Usa el ID de la orden obtenida
            'product_id' => $product->id, // Usa el ID del producto obtenido
            'quantity' => 2, // Cantidad del producto
            'price' => $product->price // Precio del producto
        ]);

        OrderItem::create([
            'order_id' => $order->id, // Usa el ID de la orden obtenida
            'product_id' => $product_2->id, // Usa el ID del producto obtenido
            'quantity' => 1, // Cantidad del producto
            'price' => $product_2->price // Precio del producto
        ]);
    }
}
