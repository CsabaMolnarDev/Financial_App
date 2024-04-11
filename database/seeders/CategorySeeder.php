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
            // Create 5 spending categories
        Category::factory()->count(5)->state(['type' => 'spending'])->create();
        
        // Create 5 income categories
        Category::factory()->count(5)->state(['type' => 'income'])->create();
    }
}
