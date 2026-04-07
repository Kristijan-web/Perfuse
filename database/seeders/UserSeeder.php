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
        User::create(['name' => 'Kristijan', 'email' => 'krimster8@gmail.com', 'password' => Hash::make('cao123'), 'role_id' => Role::where('name', 'admin')->first()->id]);
        User::create(['name' => 'Pera', 'email' => 'petar1@gmail.com', 'password' => Hash::make('password'), 'role_id' => Role::where('name', 'user')->first()->id]);

        User::factory(10)->create();


    }
}
