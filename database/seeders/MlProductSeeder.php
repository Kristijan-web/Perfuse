<?php

namespace Database\Seeders;

use App\Models\MlProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MlProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // MlProduct::factory(10)->create();

        MlProduct::firstOrCreate(['ml_id' => 1, "product_id" => 1]);
        MlProduct::firstOrCreate(['ml_id' => 2, "product_id" => 1]);
        MlProduct::firstOrCreate(['ml_id' => 3, "product_id" => 1]);

        MlProduct::firstOrCreate(['ml_id' => 1, "product_id" => 2]);
        MlProduct::firstOrCreate(['ml_id' => 2, "product_id" => 2]);
        MlProduct::firstOrCreate(['ml_id' => 3, "product_id" => 2]);

        MlProduct::firstOrCreate(['ml_id' => 1, "product_id" => 3]);
        MlProduct::firstOrCreate(['ml_id' => 2, "product_id" => 3]);
        MlProduct::firstOrCreate(['ml_id' => 3, "product_id" => 3]);
    }
}
