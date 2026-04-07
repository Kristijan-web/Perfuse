<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Brand::firstorCreate(['title' => 'Zara']);
        Brand::firstorCreate(['title' => 'Exmoor']);
        Brand::firstorCreate(['title' => 'Davidoff']);
        Brand::firstorCreate(['title' => 'Chanel']);
        Brand::firstorCreate(['title' => 'Dior']);
        Brand::firstorCreate(['title' => 'Versace']);
    }
}
