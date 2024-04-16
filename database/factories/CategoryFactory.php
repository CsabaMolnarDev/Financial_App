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

        $categories = [];

        if ($type === 'spending') {
            shuffle($spendingCategories);
            $categories = array_slice($spendingCategories, 0, 5);
        } else {
            shuffle($incomeCategories);
            $categories = array_slice($incomeCategories, 0, 5);
        }

        return [
            'name' => $this->faker->randomElement($categories),
            'type' => $type,
        ];
    }
}
