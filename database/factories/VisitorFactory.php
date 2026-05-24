<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $visitableTypes = [
            Post::class,
            User::class,
        ];
        $data = [
            'country' => fake()->country(),
            'city' => fake()->city(),
            'device' => fake()->randomElement([
                'mobile',
                'desktop',
                'tablet',
            ]),
        ];

        return [
            'visitable_type' => fake()->randomElement($visitableTypes),
            'visitable_id' => function (array $attributes) {
                $modelClass = $attributes['visitable_type'];
                return $modelClass::inRandomOrder()->value('id');
            },
            'session_id' => fake()->uuid,
            'ip_address' => fake()->ipv4,
            'user_agent' => fake()->userAgent,
            'referer' => fake()->url,
            'data' => collect($data)->only(array_rand($data, rand(1, count($data))))->toArray(),
        ];
    }
}
