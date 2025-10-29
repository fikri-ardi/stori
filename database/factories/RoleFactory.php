<?php

namespace Database\Factories;

use Database\Seeders\RoleSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
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
        $roles = ['founder', 'admin', 'author', 'user'];

        return [
            'name' => fake()->randomElement($roles),
            'description' => fake()->sentence(),
        ];
    }
}
