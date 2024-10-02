<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Price;
use App\Models\Rental;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $rentalsData = [
            [
                'type' => 'Mini Van',
                'brand' => 'Toyota',
                'name' => 'Avanza',
                'seat' => 6,
                'luggage' => 2,
                'door' => 4,
                'transmission' => 'Automatic',
                'fuel' => 'Petrol',
                'image' => 'avanza.png',
                'prices' => [
                    ['duration' => 24, 'amount' => 16.6667],  // Converted from 250,000 IDR
                    ['duration' => 5, 'amount' => 23.3333],   // Converted from 350,000 IDR
                    ['duration' => 8, 'amount' => 33.3333],   // Converted from 500,000 IDR
                    ['duration' => 12, 'amount' => 50.0],     // Converted from 750,000 IDR
                ],
            ],
            [
                'type' => 'Mini Van',
                'brand' => 'Toyota',
                'name' => 'Inova',
                'seat' => 7,
                'luggage' => 2,
                'door' => 4,
                'transmission' => 'Automatic',
                'fuel' => 'Petrol',
                'image' => 'inova.png',
                'prices' => [
                    ['duration' => 24, 'amount' => 33.3333],  // Converted from 500,000 IDR
                    ['duration' => 5, 'amount' => 46.6667],   // Converted from 690,000 IDR
                    ['duration' => 8, 'amount' => 59.3333],   // Converted from 880,000 IDR
                    ['duration' => 12, 'amount' => 66.6667],  // Converted from 1,000,000 IDR
                ],
            ],
            [
                'type' => 'Mini Buss',
                'brand' => 'Toyota',
                'name' => 'Hiace',
                'seat' => 16,
                'luggage' => 4,
                'door' => 4,
                'transmission' => 'Manual',
                'fuel' => 'Petrol',
                'image' => 'hiace.png',
                'prices' => [
                    ['duration' => 24, 'amount' => 40.0],     // Converted from 600,000 IDR
                    ['duration' => 5, 'amount' => 55.3333],   // Converted from 830,000 IDR
                    ['duration' => 8, 'amount' => 70.0],      // Converted from 1,050,000 IDR
                    ['duration' => 12, 'amount' => 80.0],     // Converted from 1,200,000 IDR
                ],
            ],
            [
                'type' => 'Regular Bike',
                'brand' => 'Yamaha',
                'name' => 'N-Max',
                'seat' => 2,
                'luggage' => 0,
                'door' => 0,
                'transmission' => 'Automatic',
                'fuel' => 'Petrol',
                'image' => 'nmax.png',
                'prices' => [
                    ['duration' => 24, 'amount' => 5.0],      // Converted from 75,000 IDR
                ],
            ],
        ];

        foreach ($rentalsData as $rentalData) {
            $type = Type::where('name', $rentalData['type'])->first();
            $brand = Brand::where('name', $rentalData['brand'])->first();

            if (!$type || !$brand) {
                continue; // Skip if type or brand is not found
            }

            $rental = new Rental([
                'type_id' => $type->id,
                'brand_id' => $brand->id,
                'name' => $rentalData['name'],
                'seat' => $rentalData['seat'],
                'luggage' => $rentalData['luggage'],
                'door' => $rentalData['door'],
                'transmission' => $rentalData['transmission'],
                'fuel' => $rentalData['fuel'],
                'imagePath' => $this->uploadImage($rentalData['image']),
            ]);
            $rental->save();

            foreach ($rentalData['prices'] as $priceData) {
                $price = new Price($priceData);
                $rental->prices()->save($price);
            }
        }
    }

    private function uploadImage($filename)
    {
        $path = 'images/seeder/rentals/';
        $fullPath = $path . $filename;

        // Assuming you have a 'public' disk configured in your filesystems.php config file
        // Storage::disk('public')->put($fullPath, file_get_contents(public_path("images/seeder/rentals/$filename")));

        return $fullPath;
    }
}
