<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => 'AN_'. fake()->ean8(),
            'name' => fake()->name,
            'order_sum' => rand(1, 50),
            'currency_id' => rand(1,2),
            'paid_at' => fake()->dateTimeBetween($startDate = '-30 days', $endDate = 'now', $timezone = null),
        ];
    }
}
