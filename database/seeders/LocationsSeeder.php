<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [2, 'GUADALAJARA'],
            [3, 'MONTERREY'],
            [6, 'CIUDAD DE MEXICO'],
            [7, 'MERIDA'],
            [8, 'CHIHUAHUA'],
            [9, 'CENTRO LOGISTICO'],
            [10, 'QUERETARO'],
            [18, 'GDL SCRAP'],
        ];
        foreach ($locations as $location) {
            Location::create([
                'location' => $location[0],
                'name' => $location[1],
            ]);
        }
    }
}
