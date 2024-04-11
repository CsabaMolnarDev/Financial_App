<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $spendingCategories = ['Freetime', 'Hobby', 'Food', 'Sport', 'Transportation'];
        $incomeCategories = ['Salary', 'Bonus', 'Investment', 'Gift', 'Rent'];
        $types = ['spending', 'income'];
        $type = $this->faker->randomElement($types);
        
        $name = ($type === 'spending') 
            ? $this->faker->unique()->randomElement($spendingCategories) 
            : $this->faker->unique()->randomElement($incomeCategories);
            return [
                'name' => $name,
                'type' => $type,
            ];
    }
}
