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
            'category_id' => 1,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 25.5,
            'length' => 210.8,
            'width' => 104.8,
            'height' => 3.5,
        ]);

        Product::create([
            'name' => 'PAN SOL LONGI MONO PERC HALF CELL 550W',
            'brand' => 'LONGI',
            'category_id' => 1,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 27.2,
            'length' => 225.6,
            'width' => 113.3,
            'height' => 3.5,
        ]);

        Product::create([
            'name' => 'PAN SOL RISEN MONO PERC HALF CELL 450W',
            'brand' => 'RISEN',
            'category_id' => 1,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 27.8,
            'length' => 227.9,
            'width' => 104.8,
            'height' => 3.5,
        ]);
    }
}
