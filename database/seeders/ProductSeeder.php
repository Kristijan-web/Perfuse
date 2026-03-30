<?php

namespace Database\Seeders;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Product::factory()
        //     ->has(
        //         Images::factory()
        //             ->count(5)
        //             ->state(new Sequence(
        //                 ['is_new' => true],
        //                 ['is_new' => false],
        //                 ['is_new' => false],
        //                 ['is_new' => false],
        //                 ['is_new' => false],
        //             ))
        //     )
        //     ->create();

        Product::factory(10)->create();
    }
}
