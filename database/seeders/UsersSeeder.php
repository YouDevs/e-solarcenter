<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Enums\RolesEnums;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super = [
            'name' =>'Super',
            'email' =>'super@super.com',
            'password' => \bcrypt('12345'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user = new User();
        $user->fill($super);
        $user->save();
        $user->assignRole(RolesEnums::ADMINISTRATION);

        // OPERADOR
        $operator_user = [
            'name' =>'Operador',
            'email' =>'operador@operador.com',
            'password' => \bcrypt('12345'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user_operator = new User();
        $user_operator->fill($operator_user);
        $user_operator->save();
        $user_operator->assignRole(RolesEnums::OPERATOR);

        // ADMINISTRADOR
        $administration_user = [
            'name' =>'Administración',
            'email' =>'admin@admin.com',
            'password' => \bcrypt('12345'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user_administration = new User();
        $user_administration->fill($administration_user);
        $user_administration->save();
        $user_administration->assignRole(RolesEnums::ADMINISTRATION);

        $customer_support = [
            'name' =>'Atención al Cliente',
            'email' =>'support@support.com',
            'password' => \bcrypt('12345'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user_customer_support = new User();
        $user_customer_support->fill($customer_support);
        $user_customer_support->save();
        $user_customer_support->assignRole(RolesEnums::CUSTOMER_SUPPORT);

        $marketing = [
            'name' =>'Marketing',
            'email' =>'mkt@mkt.com',
            'password' => \bcrypt('12345'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user_marketing = new User();
        $user_marketing->fill($marketing);
        $user_marketing->save();
        $user_marketing->assignRole(RolesEnums::MARKETING);

        //TODO: CREAR USUARIO ALMACÉN.


        // CUSTOMER
        $customer = [
            'name' =>'customer',
            'email' =>'customer@customer.com',
            'password' => \bcrypt('12345'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user_customer = new User();
        $user_customer->fill($customer);
        $user_customer->save();
        $user_customer->assignRole(RolesEnums::CUSTOMER);

        Customer::create([
            'user_id' => $user_customer->id,
            'company_name' => 'SUNE',
            'netsuite_key' => '1234567890',
            'rfc' => '0101010101011',
            'delivery_address_1' => 'Av. Industria Eléctrica 43-A',
            'delivery_address_2' => 'Av. Industria Eléctrica 43-B',
            'delivery_address_3' => 'Av. Industria Eléctrica 43-C',
            'status' => 'active'
        ]);

    }
}
