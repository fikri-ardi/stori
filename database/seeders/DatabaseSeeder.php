<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $users = User::factory(25)->create();
        $this->callWith(TagSeeder::class, compact('users'));
        $this->callWith(CollectionSeeder::class, compact('users'));

        $posts = Post::factory()
            ->recycle($users)
            ->count(20)
            ->create();

        $comments = Comment::factory()->recycle([$users, $posts])->count(200)->create();
        $this->callWith(ClapSeeder::class, compact('users', 'posts', 'comments'));
        $this->callWith(VisitorSeeder::class, compact('posts', 'users'));
    }
}