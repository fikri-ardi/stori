<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($posts, $users): void
    {
        $visitableModels = [
            $posts,
            $users,
        ];

        foreach ($visitableModels as $model) {
            $model->each(function ($instance) {
                Visitor::factory()->count(rand(10, 5167))->create([
                    'visitable_type' => get_class($instance),
                    'visitable_id' => $instance->id,
                ]);
            });
        }
    }
}
