<?php

namespace Database\Seeders;

use App\Models\Ml;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Ml::firstOrCreate(['size_ml' => 50]);
        Ml::firstOrCreate(['size_ml' => 100]);
        Ml::firstOrCreate(['size_ml' => 150]);
    }
}
