<?php

namespace Database\Seeders;

use App\Models\WaterType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        WaterType::factory(10)->create();
    }
}
