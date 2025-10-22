<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'slug' => fake()->unique()->slug(),
            'title' => cleanText(fake()->realTextBetween(5, 30)),
            'body' => cleanText(fake()->realTextBetween(400, 1000)),
            'excerpt' => cleanText(fake()->realTextBetween(50, 100)),
            'is_published' => fake()->boolean(80), // 80
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // Attach random collections to the post
            $collections = Collection::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $post->collections()->attach($collections);

            // Attach random tags to the post
            $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $post->tags()->attach($tags);

            for ($i = 0; $i < rand(1, 5); $i++) {
                $post->images()->create([
                    'url' => "https://picsum.photos/seed/post-{$post->id}-{$i}/1200/700"
                ]);
            }
        });
    }
}
