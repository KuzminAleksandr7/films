<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = random_int(0, 1);

        return [
            'title' => fake()->text(20),
            'is_published' => $random,
            'poster_url' => url('/storage/poster/no_poster.png'),
            'poster_path' => 'posters/no_poster.png',
            'published_at' => $random === 1 ? fake()->dateTimeBetween('-5 days') : null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
