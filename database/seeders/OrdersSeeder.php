<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén un cliente de ejemplo o crea uno
        $customer = Customer::find(1); // Asegúrate de que haya al menos un usuario customer.

        // Inserta una orden de ejemplo
        Order::create([
            'customer_id' => $customer->id, // Usa el ID del cliente obtenido
            'folio' => 1, // Usa el ID del cliente obtenido
            'total' => 1150, // Precio total de la orden
            'status' => 'pending_payment', // Estado de la entrega
            'method' => 'Transferencia bancaria' // Método de pago
        ]);
    }
}
