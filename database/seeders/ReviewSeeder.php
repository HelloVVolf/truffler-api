<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 10 reviews using the ReviewFactory

        Review::factory()->count(500)->create();

        // $reviews = [
        //     [
        //         'type_id' => 1,
        //         'type_type' => "App\Models\Tour",
        //         'name' => fake()->firstName() . " " . fake()->lastName(),
        //         'email' => fake()->unique()->safeEmail,
        //         'status' => 'approved',
        //         'value' => 5,
        //         'title' => "Such a Wonderful Ubud Tour!",
        //         'text' => "My partner and I recently went on an Ubud tour with Truffler, and it was fantastic! The car they provided was spotless, which we really appreciated. Our guide, Aam, was amazing. He knew so much about the area and kept us entertained with his stories and jokes throughout the tour. Aam made sure we had a great time and even shared insights into local culture. Overall, we had a fantastic experience with Truffler and would highly recommend them for your Ubud adventure!",
        //     ],
        //     [
        //         'type_id' => 1,
        //         'type_type' => "App\Models\Tour",
        //         'name' => fake()->firstName() . " " . fake()->lastName(),
        //         'email' => fake()->unique()->safeEmail,
        //         'status' => 'approved',
        //         'value' => 5,
        //         'title' => "Enchanting Ubud Tour with Truffler!",
        //         'text' => "My recent tour with Truffler in Ubud was fantastic! The car was spotless, and our guide, Made, was a delight. He shared so much about Ubud's history and culture, making the experience really special. Made's passion for Ubud shone through as he shared captivating stories and personalized the tour to our interests. Truffler provided an exceptional experience, largely thanks to Made's expertise and hospitality. If you're looking for an unforgettable adventure in Ubud, Truffler is the way to go!",
        //     ],
        //     [
        //         'type_id' => 1,
        //         'type_type' => "App\Models\Tour",
        //         'name' => fake()->firstName() . " " . fake()->lastName(),
        //         'email' => fake()->unique()->safeEmail,
        //         'status' => 'approved',
        //         'value' => 5,
        //         'title' => "Immersive Bali Cultural",
        //         'text' => "Our Bali adventure was truly extraordinary! Led by our guide, Putu, we delved into the island's rich culture and history. Each stop revealed new discoveries, from ancient temples to lush landscapes. Putu's warmth and expertise made every moment unforgettable, offering a truly authentic Bali experience. In summary, our immersive cultural exploration was unforgettable. If you want to dive deep into Bali's culture, this adventure is a must!",
        //     ],
        //     [
        //         'type_id' => 1,
        //         'type_type' => "App\Models\Tour",
        //         'name' => fake()->firstName() . " " . fake()->lastName(),
        //         'email' => fake()->unique()->safeEmail,
        //         'status' => 'approved',
        //         'value' => 5,
        //         'title' => "Authentic Bali",
        //         'text' => "Our recent Bali adventure was an unforgettable cultural immersion! Led by our knowledgeable guide, Putu, we explored hidden gems and ancient sites, soaking in Bali's rich heritage. Putu's warmth and expertise made every moment special, creating memories to cherish. If you crave an authentic Bali experience, this is it!",
        //     ],
        //     [
        //         'type_id' => 1,
        //         'type_type' => "App\Models\Tour",
        //         'name' => fake()->firstName() . " " . fake()->lastName(),
        //         'email' => fake()->unique()->safeEmail,
        //         'status' => 'approved',
        //         'value' => 5,
        //         'title' => "Wonderful experience",
        //         'text' => "Our recent trip with Truffler in Bali was absolutely fantastic! The car was spotless, and our guide, Putu, was incredibly knowledgeable and friendly. He shared fascinating stories about Bali's history and culture, making the journey even more enjoyable. Putu's hospitality truly made the experience unforgettable.",
        //     ],
        //     [
        //         'type_id' => 1,
        //         'type_type' => "App\Models\Tour",
        //         'name' => fake()->firstName() . " " . fake()->lastName(),
        //         'email' => fake()->unique()->safeEmail,
        //         'status' => 'approved',
        //         'value' => 5,
        //         'title' => "Amazing",
        //         'text' => "Our recent Bali adventure with Truffler was truly exceptional! From the moment we embarked on our journey, we were enthralled by our guide, Made's, insightful commentary and warm hospitality. Made's passion for Bali's culture and history made each stop along the way an enriching experience. Truffler's attention to detail and Made's expertise ensured that every moment was memorable, making it an unforgettable Bali exploration.",
        //     ],
        // ];

        // foreach ($reviews as $review) {
        //     Review::create([
        //         'type_id' => $review['type_id'],
        //         'type_type' => $review['type_type'],
        //         'name' => $review['name'],
        //         'email' => $review['email'],
        //         'status' => $review['status'],
        //         'value' => $review['value'],
        //         'title' => $review['title'],
        //         'text' => $review['text'],
        //     ]);
        // }
    }
}
