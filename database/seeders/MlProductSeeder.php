<?php

namespace Database\Seeders;

use App\Models\MlProduct;
use App\Models\Product;
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
        $timestamp = now();
        $rows = [];

        foreach (Product::query()->pluck('id') as $productId) {
            foreach ([1, 2, 3] as $mlId) {
                $rows[] = [
                    'ml_id' => $mlId,
                    'product_id' => $productId,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }

        MlProduct::query()->insertOrIgnore($rows);
    }
}
