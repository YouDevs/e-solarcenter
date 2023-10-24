<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categories = ['Sistemas Interconectados','Sistemas Híbridos', 'Sistemas Autónomos', 'Calentadores Solares'];
        $categories = ['Paneles', 'Inversores', 'Microinversores', 'Monitores' ,'Estructuras'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

    }
}
