<?php

namespace Database\Seeders;

use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $users = User::factory(5)->create();
        $tags = Tag::factory()->count(50)->create();
        $this->callWith(CollectionSeeder::class, compact('users'));
        $posts = Post::factory()->recycle($users)->count(9)->create();
        $comments = Comment::factory()->recycle([$users, $posts])->count(200)->create();
        $this->callWith(ClapSeeder::class, compact('users', 'posts', 'comments'));
        $this->callWith(VisitorSeeder::class, compact('posts', 'users'));
    }
}
