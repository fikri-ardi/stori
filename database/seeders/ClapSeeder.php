<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $clappableTypes = [
            \App\Models\Post::class,
            \App\Models\Comment::class,
        ];
        foreach ($users as $user) {
            foreach ($clappableTypes as $type) {
                $items = $type::inRandomOrder()->take(rand(1, 5))->get();
                foreach ($items as $item) {
                    $user->claps()->create([
                        'clappable_type' => $type,
                        'clappable_id' => $item->id,
                        'count' => rand(1, 10),
                    ]);
                }
            }
        }
    }
}
