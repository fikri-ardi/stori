<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect(['founder', 'admin', 'author', 'user']);

        $roles->each(function ($role) {
            Role::create([
                'name' => $role,
                'description' => ucfirst($role) . ' role',
            ]);
        });
    }
}
