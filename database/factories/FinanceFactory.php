<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finance>
 */
class FinanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $array = ['Income', 'Spending'];
        $array2 = ['Restaurant', 'Freetime','Taxes','Shoping'];
        $array3 =['eur','huf','usd','gbp'];
        return [
            'type' => $array[rand(0,1)],
            'name' => fake()->name(),
            'category' => $array2 [rand(0,3)],
            'price' => fake()->numberBetween(1,50),
            'currency' => $array3[rand(0,3)],
            'time' => fake()->date()
        ];
    }
}
