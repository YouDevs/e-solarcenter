<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('model_has_roles')->truncate();
        DB::table('roles')->truncate();

        $roles = ['super_admin', 'operator', 'administration', 'customer_support', 'marketing', 'warehouse', 'customer'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
