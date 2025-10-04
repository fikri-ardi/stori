<?php

namespace Database\Factories;

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
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'slug' => $this->faker->unique()->slug(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->optional()->sentence(),
            'is_published' => $this->faker->boolean(80), // 80
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Post $post) {
            // Attach random collections to the post
            $collections = \App\Models\Collection::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $post->collections()->attach($collections);
        });
    }
}
