<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = collect(['Self-Dev', 'Tech', 'Web', 'Mobile', 'Books', 'Movies', 'Series', 'Music', 'Podcasts', 'Health', 'Fitness', 'Travel', 'Food', 'Recipes', 'Art', 'Design', 'Photography', 'Science', 'History', 'Education', 'Finance', 'Business', 'Marketing', 'Productivity', 'Lifestyle', 'Gaming']);

        $collections->each(function ($collection) {
            Collection::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => $collection,
            ]);
        });
    }
}
