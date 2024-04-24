<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomerAddress;

class CustomerAddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerAddress::create([
            'customer_id' => 1,
            'is_default' => 0,
            'street' => 'DZILAN BRAVO',
            'postal_code' => '97606',
            'neighborhood' => 'DZILAN BRAVO',
            'country' => 'México',
            'state' => 'Yucatán',
            'city' => 'Yucatán',
        ]);

        CustomerAddress::create([
            'customer_id' => 1,
            'is_default' => 1,
            'street' => 'FCO I MADERO SUC MET07B',
            'postal_code' => '72130',
            'neighborhood' => 'DZILAN BRAVO',
            'country' => 'México',
            'state' => 'Puebla',
            'city' => 'JUAREZ Y BENITO JUAREZ',
        ]);

        CustomerAddress::create([
            'customer_id' => 1,
            'is_default' => 0,
            'street' => 'CARRET ANT ARTEAGA',
            'postal_code' => '25350',
            'neighborhood' => 'RURAL AG OTE',
            'country' => 'México',
            'state' => 'Coahuila',
            'city' => 'JUAREZ Y BENITO JUAREZ',
        ]);
    }
}
