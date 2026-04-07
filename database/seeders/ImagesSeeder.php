<?php

namespace Database\Seeders;

use App\Models\Images;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $images = Images::factory()->count(15)->create();

        // now you have ALL of them
        $images->each(function ($image) use ($images) {
            // full access to collection

            // ovde sad treba da uzmem images proizvod id i da izvucem sve image za taj proizvod


            $product_id = $image->product_id;

            $certainProduct = Images::where('product_id', $product_id)->first(); // imam jednu sliku za x proizvod

            // ako je $certainProduct length = 1 onda dodeli 1 odmah
            if ($certainProduct->count() === 1) {
                $certainProduct->is_main_image = 1;
            }


            $certainProduct->is_main_image = 1;

            $certainProduct->save();

        });
    }
}
