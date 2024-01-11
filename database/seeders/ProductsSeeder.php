<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'PAN SOL LONGI MONOPERC HALFCELL 575W',
            'brand' => 'RISEN',
            'price' => 400.00,
            'category_id' => 1,
            'sku' => 'PV-PS-575-LNG',
            'netsuite_stock' => 10,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
        ]);

        Product::create([
            'name' => 'PAN SOL LONGI MONO PERC HALF CELL 550W',
            'brand' => 'LONGI',
            'price' => 350.00,
            'category_id' => 1,
            'sku' => 'PV-PS-550-LNG',
            'netsuite_stock' => 10,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
        ]);

        Product::create([
            'name' => 'PAN SOL RISEN MONO PERC HALF CELL 450W',
            'brand' => 'RISEN',
            'price' => 150.00,
            'category_id' => 1,
            'sku' => 'PV-PS-450-RSN',
            'netsuite_stock' => 10,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
        ]);
    }
}
