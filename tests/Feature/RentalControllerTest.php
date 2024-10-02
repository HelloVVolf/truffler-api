<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RentalControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_store_method_creates_rental_with_prices()
    {
        $data = [
            'name' => 'Car Name',
            'brand' => 'Car Brand',
            'prices' => [
                [
                    'amount' => 50,
                    'duration' => 8,
                ],
                [
                    'amount' => 80,
                    'duration' => 12,
                ],
            ],
        ];

        $response = $this->postJson('/api/rentals', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Rental and Price data submitted successfully']);

        // Additional assertions based on your application logic
    }
}
