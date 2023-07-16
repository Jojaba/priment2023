<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => fake()->lastName(),
            'forename'  => fake()->firstName(),
            'identity'  => fake()->randomElement(['élève','parent','enseignant','administratif','vacataire','visiteur']),
            'role'      => 0,
            'birthdate' => fake()->date(),
            'classroom' => fake()->randomElement(['salle 1','salle 2','salle 3']),
            'class'     => fake()->randomElement(['Classe de Monsieur Dupuis','Classe de Madame Frumholz','Classe de Madame Laurer']),
            'level'     => fake()->randomElement(['CP','CE1','CE2','CM1','CM2','ULIS']),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => bcrypt('priment2023'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
