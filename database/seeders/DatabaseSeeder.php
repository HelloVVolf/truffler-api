<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PlaceCategory;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Rental::factory(3)->create();
        // \App\Models\Price::factory(10)->create();

        User::create([
            'user_role_id' => 1,
            'email' => 'admin@admin',
            'username' => 'administrator',
            'first_name' => 'Administrator',
            'password' => bcrypt('Neverquit911!')

        ]);
        $types = ['Small', 'Mini Van', 'SUV', 'Mini Buss', 'Scooter', 'Regular Bike', 'Sport Bike'];

        foreach ($types as $type) {
            Type::create(
                [
                    'name' => $type,
                ]
            );
        }

        $categories = [
            'Waterfalls',
            'Religious Sites',
            'Jungles',
            'Wildlife and Nature Reserves',
            'Beaches',
            'Mountains & Hills',
            'Nightlife and Entertainment',
            'Beach Clubs',
            'Cafes and Restaurants',
            'Water Parks',
            'Amusement & Theme Parks',
            'Rice Terraces',
            'Cultural and Art Centers',
            'Adventure and Outdoor Activities',
            'Markets and Shopping Districts',
            'Spas and Wellness Centers',
            'Museums',
            'Educational and Conservation Centers',
            'Villages and Cultural Experiences',
            'Surfing Spots',
            'Diving and Snorkeling Spots',
            'Festivals and Events',
            'Golf Courses',
            'Swing and Adventure Parks',
            'Historical Sites',
            'Education and Workshops',
            'Plantations',
            'Health and Wellness Retreats',
            'Local Warungs (Eateries)',
            'Cycling and Trekking Routes',
            'Hiking Areas',
            'Lakes',
            'Points of Interest & Landmarks',
        ];

        foreach ($categories as $category) {
            PlaceCategory::create(
                [
                    'name' => $category,
                ]
            );
        }

        $this->call([
            CitySeeder::class,
            BrandSeeder::class,
            RentalSeeder::class,
            PlaceSeeder::class,
            TourCategorySeeder::class,
            TourTagSeeder::class,
            TourSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
