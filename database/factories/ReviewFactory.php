<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tourIds = Tour::pluck('id')->all();

        return [
            'type_id' => fake()->randomElement($tourIds),
            'type_type' => "App\Models\Tour",
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'value' => fake()->numberBetween(4, 5),
            'title' => fake()->sentence,
            'text' => fake()->paragraph,
        ];
    }
}
