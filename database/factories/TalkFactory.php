<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class TalkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject'           => fake()->sentence(8),
            'author_id'         => fake()->numberBetween(0, 120),
            'content'           => fake()->paragraph(),
            'recipients_id'     => fake()->numberBetween(0, 120),
            'created_at'        => now(),
            'updated_at'        => now()
        ];
    }
}
