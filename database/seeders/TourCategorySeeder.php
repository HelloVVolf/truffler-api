<?php

namespace Database\Seeders;

use App\Models\TourCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Private',
            'Public Group',
        ];

        foreach ($categories as $category) {
            TourCategory::create(
                [
                    'name' => $category,
                ]
            );
        }
    }
}
