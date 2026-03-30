<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // JA ovde mora da napravim celog usera
        User::create(['name' => 'Kristijan', 'email' => 'kristijan1@gmail.com', 'password' => Hash::make('password'), 'role_id' => Role::where('role', 'user')->first()->id]);
        User::create(['name' => 'Pera', 'email' => 'petar1@gmail.com', 'password' => Hash::make('password'), 'role_id' => Role::where('role', 'admin')->first()->id]);

        User::factory(10)->create();


    }
}
