<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_number' => 'ORD-' . strtoupper(fake()->unique()->bothify('??###')),
            'amount' => fake()->randomFloat(2, 100, 10000),
            'status' => fake()->randomElement(['pending', 'completed', 'cancelled']),
            'order_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}