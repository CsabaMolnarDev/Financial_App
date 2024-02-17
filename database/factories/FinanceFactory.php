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


        return [
            'type' => $array[rand(0,1)],
            'name' => fake()->name(),
            'price' => fake()->numberBetween(1,50),
            'time' => fake()->date(),
            'currencies_id' => 11,
        ];
    }
}
