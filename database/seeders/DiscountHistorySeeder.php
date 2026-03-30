<?php

namespace Database\Seeders;

use App\Models\DiscountHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DiscountHistory::factory(10)->create();

    }
}
