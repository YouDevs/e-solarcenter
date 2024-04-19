<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductStock;

class ProductStocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product id 1
        ProductStock::create([
            'product_id' => 1,
            'location_id' => 3,
            'quantity_available' => 155,
        ]);
        ProductStock::create([
            'product_id' => 1,
            'location_id' => 5,
            'quantity_available' => 210,
        ]);
        ProductStock::create([
            'product_id' => 1,
            'location_id' => 2,
            'quantity_available' => 2,
        ]);
        ProductStock::create([
            'product_id' => 1,
            'location_id' => 5,
            'quantity_available' => 87,
        ]);
        ProductStock::create([
            'product_id' => 1,
            'location_id' => 1,
            'quantity_available' => 44,
        ]);

        // Product id 2
        ProductStock::create([
            'product_id' => 2,
            'location_id' => 2,
            'quantity_available' => 130,
        ]);
        ProductStock::create([
            'product_id' => 2,
            'location_id' => 3,
            'quantity_available' => 66,
        ]);

        // Product id 3
        ProductStock::create([
            'product_id' => 3,
            'location_id' => 1,
            'quantity_available' => 300,
        ]);
        ProductStock::create([
            'product_id' => 3,
            'location_id' => 4,
            'quantity_available' => 50,
        ]);
    }
}
