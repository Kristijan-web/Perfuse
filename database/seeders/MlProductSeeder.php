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
        MlProduct::factory(10)->create();
    }
}
