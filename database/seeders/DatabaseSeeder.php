<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(10)->create();


        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            WaterTypeSeeder::class,
            DiscountSeeder::class,
            ProductSeeder::class,
            ImagesSeeder::class,
            OrderSeeder::class,
            CartSeeder::class,
            OrderLineSeeder::class,
            DiscountHistorySeeder::class,
            MlSeeder::class,
            MlProductSeeder::class,
            CartItemSeeder::class,
            ContactSeeder::class
        ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
