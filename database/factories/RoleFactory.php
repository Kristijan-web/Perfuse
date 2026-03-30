<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // kako se popunjava role sa fiksnim vrednostima kao sto su user i admin
        return [
            //  

            // unutar seedera su definisani koji podaci ce biti insertovani i koliko

        ];
    }
}
