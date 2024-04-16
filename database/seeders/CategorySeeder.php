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
        Category::factory()->create([
            'name' => 'Freetime',
            'type' => 'spending',
        ]);
        
        Category::factory()->create([
            'name' => 'Hobby',
            'type' => 'spending',
        ]);
        
        Category::factory()->create([
            'name' => 'Food',
            'type' => 'spending',
        ]);
        
        Category::factory()->create([
            'name' => 'Sport',
            'type' => 'spending',
        ]);
        
        Category::factory()->create([
            'name' => 'Transportation',
            'type' => 'spending',
        ]);
        
        Category::factory()->create([
            'name' => 'Salary',
            'type' => 'income',
        ]);
        
        Category::factory()->create([
            'name' => 'Bonus',
            'type' => 'income',
        ]);
        
        Category::factory()->create([
            'name' => 'Investment',
            'type' => 'income',
        ]);
        
        Category::factory()->create([
            'name' => 'Gift',
            'type' => 'income',
        ]);
        
        Category::factory()->create([
            'name' => 'Rent',
            'type' => 'income',
        ]);
    }
}
