<?php

namespace Database\Factories;

use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'start_date' => Carbon::now(),
        ];
    }
}
