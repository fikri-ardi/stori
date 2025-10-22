<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($users, $posts, $comments): void
    {
        $clappableModels = [
            $posts,
            $comments,
        ];

        foreach ($users as $user) {
            foreach ($clappableModels as $model) {
                $instances = $model->random()->take(rand(1, 5))->get();
                foreach ($instances as $instance) {
                    $user->claps()->create([
                        'clappable_type' => get_class($instance),
                        'clappable_id' => $instance->id,
                        'count' => rand(1, 50),
                    ]);
                }
            }
        }
    }
}
