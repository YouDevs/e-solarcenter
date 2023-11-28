<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('users')->truncate();
        // DB::table('model_has_roles')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(OrderItemsSeeder::class);
        $this->call(OrderStatusSeeder::class);
    }
}
