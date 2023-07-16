<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'             => fake()->sentence(8),
            'author_id'         => fake()->numberBetween(0, 120),
            'keywords'          => fake()->word(),
            'url'               => fake()->url(),
            'location'          => 'web',
            'type'              => fake()->randomElement(['doc', 'pdf', 'mp4', 'svg']),
            'res_liked_users'   => fake()->numberBetween(0, 120),
            'state'             => fake()->randomElement(['published', 'draft', 'awaiting', 'unpublished']),
            'created_at'        => now(),
            'updated_at'        => now()
        ];
    }
}
