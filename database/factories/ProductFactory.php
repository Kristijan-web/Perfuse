<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Discount;
use App\Models\Product;
use App\Models\WaterType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
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
            'title' => fake()->words(1, true),
            'price' => fake()->numberBetween(10, 10000),
            'gender' => fake()->randomElement(['male', 'female']),
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'water_type_id' => WaterType::inRandomOrder()->first()->id,
            'discount_id' => fake()->boolean(90) ? Discount::inRandomOrder()->first()->id : NULL,
        ];
    }
}
