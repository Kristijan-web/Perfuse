<?php

namespace Database\Factories;

use App\Models\Ml;
use App\Models\MlProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MlProduct>
 */
class MlProductFactory extends Factory
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
            // 
            'ml_id' => Ml::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,

        ];
    }
}
