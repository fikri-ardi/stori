<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = collect(['founder', 'admin', 'author', 'user']);

        return $roles->map(fn($name) => Role::create([
            'name' => $name,
            'description' => $name . ' role',
        ]));
    }
}
