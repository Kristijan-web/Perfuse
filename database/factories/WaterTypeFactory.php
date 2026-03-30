<?php

namespace Database\Factories;

use App\Models\WaterType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WaterType>
 */
class WaterTypeFactory extends Factory
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
            'type' => 'type' . fake()->lexify('????????')
        ];
    }
}
