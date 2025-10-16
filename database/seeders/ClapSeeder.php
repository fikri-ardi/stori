<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $clappableModels = [
            \App\Models\Post::class,
            \App\Models\Comment::class,
        ];

        foreach ($users as $user) {
            foreach ($clappableModels as $model) {
                $items = $model::inRandomOrder()->take(rand(1, 5))->get();
                foreach ($items as $item) {
                    $user->claps()->create([
                        'clappable_type' => $model,
                        'clappable_id' => $item->id,
                        'count' => rand(1, 50),
                    ]);
                }
            }
        }
    }
}
