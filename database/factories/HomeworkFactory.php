<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class HomeworkFactory extends Factory
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
            'classroom'         => fake()->randomElement(['Salle 1','Salle 2','Salle 3']),
            'class'             => fake()->randomElement(['Classe de Monsieur Dupuis','Classe de Madame Frumholz','Classe de Madame Laurer']),
            'author_id'         => fake()->numberBetween(0, 120),
            'slug'              => fake()->slug(),
            'content'           => fake()->paragraph(),
            'date'              => fake()->date(),
            'time'              => fake()->time(),
            'associated_res'    => fake()->numberBetween(0, 20),
            'hw_liked_users'    => fake()->numberBetween(0, 120),
            'state'             => fake()->randomElement(['published', 'draft', 'awaiting', 'unpublished']),
            'created_at'        => now(),
            'updated_at'        => now()
        ];
    }
}
