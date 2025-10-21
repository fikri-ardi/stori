<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        User::factory(50)->create();
        $this->call(CollectionSeeder::class);
        Tag::factory()->count(50)->create();
        Post::factory()->count(100)->create();
        Comment::factory()->count(200)->create();
        $this->call(ClapSeeder::class);
        $this->call(VisitorSeeder::class);
    }
}