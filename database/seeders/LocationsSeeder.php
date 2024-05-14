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
            ['CHIHUAHUA', 8],
            ['CIUDAD DE MEXICO', 6],
            ['GUADALAJARA', 2],
            ['MONTERREY', 3],
            ['QUERETARO', 10],
            ['CENTRO LOGISTICO', 9, ],
            ['MERIDA', 7],
            //NOTA: RESTO DE SUCURSALES QUE TRAE NETSUITE QUE NO SE USAN PARA E-COMMERCE:
            // ['GARANTIAS', 17],
            // ['PREVENTA CL', 121],
            // ['CONSIGNACION VENTAS', 11],
            // ['GDL SCRAP', 18],
            // ['GDL SHW', 16],
            // ['AUDITORIA', 118],
            // ['CL MID', 119],
            // ['CL QRO', 116],
            // ['CL GDL', 115],
            // ['CL CUU', 120],
            // ['CL MTY', 117],
            // ['TRN', 28],
            // ['OUT', 14],
            // ['SH', 29],
            // ['MTY SCRAP', 21],
            // ['NOM', 13],
            // ['QRO SHW', 23],
            // ['REF', 15],
            // ['CONS', 26],
        ];
        foreach ($locations as $location) {
            Location::create([
                'name' => $location[0],
                'netsuite_id' => $location[1],
                'netsuite_name' => $location[0]
            ]);
        }
    }
}
