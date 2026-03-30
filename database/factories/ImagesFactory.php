<?php

namespace Database\Factories;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Images>
 */
class ImagesFactory extends Factory
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
            // path, is_main_image

            'path' => 'image_path' . fake()->text(),
            'product_id' => Product::inRandomOrder()->first()->id,
            'is_main_image' => false
            // Mora da 1 is_main_mage bude true na nivou celog proizvoda, Kako ce to da izvedem?
            // - Treba mi neka funkcija koja ce trigerovati na svom insertu nove slike
            // - Ta funkcija ce proci kroz sve slike za x proizvod i zatim proveriti da li uopste postoji bar 1 is_main_image na true i ako ne postoji dodelice jednoj slici

            // Gde bih zvao tu funkciju uopste?
            // Mozda mogu da koristim obican eloquent?
            // - radi se insert nove slike, tu vec postoji id proizovda, taj id se uzme i uzmu sve slike za taj id i ako nema ni jedna sa is_main_image true setuje se jedna
            // - Da uradim nesto poput Image:: pa d

            ,

        ];
    }
}
