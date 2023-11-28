<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suponiendo que ya tienes órdenes y usuarios en tu base de datos
        // y que sus IDs son secuenciales comenzando desde 1.
        // Ajusta estos números según tu base de datos.

        // for ($i = 1; $i <= 10; $i++) {
        //     DB::table('order_status')->insert([
        //         'order_id' => $i, // Asigna un order_id existente
        //         'user_id' => $i, // Asigna un user_id existente
        //         'status' => $i % 3 == 0 ? 'cancelled' : ($i % 2 == 0 ? 'approved' : 'pending'),
        //         'cancellation_reason' => $i % 3 == 0 ? 'Razón de cancelación ' . $i : null,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }


        DB::table('order_status')->insert([
            'order_id' => 1, // Asigna un order_id existente
            'user_id' => 2, // Asigna un user_id existente
            'name' => 'pending',
            'cancellation_reason' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
