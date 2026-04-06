<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
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
            'name' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'adress' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'note' => fake()->optional()->sentence(),
            'total_price' => fake()->numberBetween(1000, 5000),
            'total_quantity' => fake()->numberBetween(1, 5),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
