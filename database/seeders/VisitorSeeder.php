<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visitableModels = [
            \App\Models\Post::class,
            \App\Models\User::class,
        ];

        foreach ($visitableModels as $model) {
            $instances = $model::all();
            foreach ($instances as $instance) {
                Visitor::factory()->count(rand(10, 100))->create([
                    'visitable_type' => $model,
                    'visitable_id' => $instance->id,
                ]);
            }
        }
    }
}
