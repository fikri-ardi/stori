<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($users): void
    {
        $tags = collect(['Self Development', 'Tech', 'Web', 'Mobile', 'Books', 'Movies', 'Series', 'Music', 'Podcasts', 'Health', 'Fitness', 'Travel', 'Food', 'Recipes', 'Art', 'Design', 'Photography', 'Science', 'History', 'Education', 'Finance', 'Business', 'Marketing', 'Productivity', 'Lifestyle', 'Gaming']);

        $tags->map(fn($name) => Tag::create([
            'name' => $name,
            'slug' => str($name)->slug(),
        ]));
    }
}