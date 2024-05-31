<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'second_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'), 
            'rude' => fake()->randomNumber(8),
            'ci' => fake()->randomNumber(9),
            'direction' => fake()->address(),
            'course' => fake()->sentence(),
            'age' => fake()->numberBetween(4, 18),
            'birth_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'institution_code' => fake()->randomNumber(4),
        ];
    }
}
