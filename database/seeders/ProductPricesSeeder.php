<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductPrice;

class ProductPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product id 2
        ProductPrice::create([
            'product_id' =>  1,
            'level' => 'Lista 1',
            'price' => 146.52,
        ]);
        ProductPrice::create([
            'product_id' =>  1,
            'level' => 'Lista 2',
            'price' => 143.75,
        ]);
        ProductPrice::create([
            'product_id' =>  1,
            'level' => 'Lista 3',
            'price' => 141.53,
        ]);

        // Product id 2
        ProductPrice::create([
            'product_id' =>  2,
            'level' => 'Lista 1',
            'price' => 144.50,
        ]);
        ProductPrice::create([
            'product_id' =>  2,
            'level' => 'Lista 2',
            'price' => 142.70,
        ]);
        ProductPrice::create([
            'product_id' =>  3,
            'level' => 'Lista 3',
            'price' => 140.50,
        ]);

        // Product id 3
        ProductPrice::create([
            'product_id' =>  3,
            'level' => 'Lista 1',
            'price' => 145.00,
        ]);
        ProductPrice::create([
            'product_id' =>  3,
            'level' => 'Lista 2',
            'price' => 143.00,
        ]);
    }
}
