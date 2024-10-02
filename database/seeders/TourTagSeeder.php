<?php

namespace Database\Seeders;

use App\Models\TourTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Cultural',
            'Adventure',
            'Nature',
            'City',
            'Historical',
            'Sightseeing',
            'Religious Site',
        ];

        foreach ($tags as $tag) {
            TourTag::create(
                [
                    'name' => $tag,
                ]
            );
        }
    }
}
