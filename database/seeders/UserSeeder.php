<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'name' => 'Fikri',
            'username' => 'fikri',
            'email' => 'fan10062003@gmail.com',
            'bio' => 'Seorang IT antusias yang suka main gitar, nyanyi. Hobi futsal, ngoding, bikin eksperimen, dan suka mencoba sesuatu yang beda.',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);
    }
}
