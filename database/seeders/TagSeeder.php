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
        $tags = collect(json_decode(file_get_contents(database_path('data/tags.json')), true));

        $tags->map(fn($name) => Tag::create([
            'name' => $name,
            'slug' => str($name)->slug(),
        ]));
    }
}
