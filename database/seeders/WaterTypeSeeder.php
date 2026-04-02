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

        // WaterType::factory(3)->create();
        WaterType::firstOrCreate(['type' => 'Parfemska']);
        WaterType::firstOrCreate(['type' => 'Toaletna']);
        WaterType::firstOrCreate(['type' => 'Kolonjska']);
    }
}
