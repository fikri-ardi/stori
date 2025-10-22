<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id' => Role::inRandomOrder()->value('id'),
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'bio' => fake()->optional()->sentence(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Attach the newly created user to random users
            $users = User::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $user->followings()->attach($users);

            // Create an avatar for the user
            $response = Http::get('https://randomuser.me/api/');
            $data = $response->json()['results'][0];

            Image::factory()->create([
                'imageable_id' => $user->id,
                'imageable_type' => User::class,
                'url' => $data['picture']['large'],
            ]);
        });
    }
}
