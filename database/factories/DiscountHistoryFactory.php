<?php

namespace Database\Factories;

use App\Models\DiscountHistory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DiscountHistory>
 */
class DiscountHistoryFactory extends Factory
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
            // product_id, start_date, end_date, was_removed, discount

            'product_id' => Product::inRandomOrder()->first()->id,
            'start_date' => fake()->dateTimeBetween('2025-01-01', '2025-06-01'),
            'end_date' => fake()->dateTimeBetween('2025-06-02', '2025-12-31'),
            'discount' => fake()->numberBetween(1, 90),
            'was_removed' => fake()->boolean(10) ? true : false,

        ];
    }
}
