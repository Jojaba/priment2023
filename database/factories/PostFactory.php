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
    public function definition()
    {
        return [
            'title'             => fake()->sentence(8),
            'target'            => fake()->randomElement(['élève','parent','enseignant','administratif','stagiaire','visiteur']),
            'author_id'         => fake()->numberBetween(0, 120),
            'slug'              => fake()->slug(),
            'content'           => fake()->paragraph(),
            'keywords'          => fake()->word(),
            'associated_res'    => fake()->numberBetween(0, 20),
            'post_liked_users'  => fake()->numberBetween(0, 120),
            'state'             => fake()->randomElement(['published', 'draft', 'awaiting', 'unpublished']),
            'pinned'            => fake()->randomElement(['true', 'false']),
            'created_at'        => now(),
            'updated_at'        => now()
        ];
    }
}
