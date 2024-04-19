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
            [1, 'GUADALAJARA', 2, 'GUADALAJARA'],
            [2, 'MONTERREY', 3, 'MONTERREY'],
            [3, 'CIUDAD DE MEXICO', 6, 'CIUDAD DE MEXICO'],
            [4, 'MERIDA', 7, 'MERIDA'],
            [5, 'CHIHUAHUA', 8, 'CHIHUAHUA'],
            [6, 'CENTRO LOGISTICO', 9, 'CENTRO LOGISTICO'],
            [7, 'QUERETARO', 10, 'QUERETARO'],
            [8, 'GDL SCRAP', 18, 'GDL SCRAP'],
        ];
        foreach ($locations as $location) {
            Location::create([
                'id' => $location[0],
                'name' => $location[1],
                'netsuite_id' => $location[2],
                'netsuite_name' => $location[3],
            ]);
        }
    }
}
