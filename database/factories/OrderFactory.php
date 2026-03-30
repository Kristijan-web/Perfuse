<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
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
            //
            // total_price i total_quantity
            'total_price' => fake()->numberBetween(5000, 1000),
            'total_quantity' => fake()->numberBetween(1, 5),
        ];
    }
}
