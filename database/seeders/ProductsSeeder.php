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
            'brand' => 'LONGI',
            'category_id' => 1,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 25.5,
            'length' => 210.8,
            'width' => 104.8,
            'height' => 3.5,
        ]);

        Product::create([
            'name' => 'INV RED FRONIUS PRIMO 15K 1F 240V',
            'brand' => 'FRONIUS',
            'category_id' => 2,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 21.5,
            'length' => 62.7,
            'width' => 42.9,
            'height' => 20.6,
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

        Product::create([
            'name' => 'PAN SOL SERAPHIM MONOPERC HALFCELL 550W',
            'brand' => 'SERAPHIM',
            'category_id' => 1,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 27,
            'length' => 227.9,
            'width' => 113.4,
            'height' => 3.5,
        ]);

        Product::create([
            'name' => 'INV RED FRONIUS PRIMO 10K 240V LT',
            'brand' => 'FRONIUS',
            'category_id' => 2,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 21.5,
            'length' => 62.7,
            'width' => 42.9,
            'height' => 20.6,
        ]);

        Product::create([
            'name' => 'MONITOREO ENVOY AM1 ENPHASE',
            'brand' => 'ENPHASE',
            'category_id' => 4,
            'data_sheet' => 'datasheet.pdf',
            'featured' => 'images/panel.webp',
            'weight' => 0.498,
            'length' => 21.3,
            'width' => 1.6,
            'height' => 4.5,
        ]);
    }
}
