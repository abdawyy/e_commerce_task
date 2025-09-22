<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        Category::insert([
            ['name' => 'Electronics', 'is_active' => true],
            ['name' => 'Clothing', 'is_active' => true],
            ['name' => 'Books', 'is_active' => true],
        ]);
    }
}
