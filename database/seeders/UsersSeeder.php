<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'password' => \bcrypt('1234abcd'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user = new User();
        $user->fill($super);
        $user->save();
        $user->assignRole(RolesEnums::SUPER_ADMIN);

        $administration_user = [
            'name' =>'Administración',
            'email' =>'admin@admin.com',
            'password' => \bcrypt('1234abcd'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user = new User();
        $user->fill($administration_user);
        $user->save();
        $user->assignRole(RolesEnums::ADMINISTRATION);

        $customer_support = [
            'name' =>'Atención al Cliente',
            'email' =>'support@support.com',
            'password' => \bcrypt('1234abcd'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user_customer = new User();
        $user_customer->fill($customer_support);
        $user_customer->save();
        $user_customer->assignRole(RolesEnums::CUSTOMER_SUPPORT);

        $customer_support = [
            'name' =>'Marketing',
            'email' =>'mkt@mkt.com',
            'password' => \bcrypt('1234abcd'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $user_customer = new User();
        $user_customer->fill($customer_support);
        $user_customer->save();
        $user_customer->assignRole(RolesEnums::MARKETING);
    }
}
