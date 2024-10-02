<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\RentalBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            "Toyota",
            "Honda",
            "Suzuki",
            "Mitsubishi",
            "Daihatsu",
            "Nissan",
            "Isuzu",
            "Ford",
            "Chevrolet",
            "BMW",
            "Mercedes-Benz",
            "Hyundai",
            "Kia",
            "Volkswagen",
            "Audi",
            "Volvo",
            "Lexus",
            "Subaru",
            "Mazda",
            "Jaguar",
            "Land Rover",
            "Ferrari",
            "Lamborghini",
            "Porsche",
            "Tesla",
            "Jeep",
            "Chrysler",
            "Dodge",
            "Ram",
            "Maserati",
            "MINI",
            "Fiat",
            "Alfa Romeo",
            "Smart",
            "Buick",
            "Cadillac",
            "GMC",
            "Acura",
            "Infiniti",
            "Lincoln",
            "Bentley",
            "Bugatti",
            "McLaren",
            "Rolls-Royce",
            "Maybach",

            "Yamaha",
            "Suzuki",
            "Kawasaki",
            "Harley-Davidson",
            "Ducati",
            "BMW Motorrad",
            "Triumph",
            "KTM",
            "Aprilia",
            "Moto Guzzi",
            "Indian Motorcycle",
            "Royal Enfield",
            "Husqvarna",
            "Piaggio",
            "Vespa",
            "Kymco",
            "SYM",
            "Benelli",
            "MV Agusta",
            "Energica",
            "Norton",
            "Bimota",
            "Husaberg",
            "Daelim",
            "Derbi",
            "Gilera",
            "Hyosung",
            "Laverda",
            "Peugeot Scooters",
            "Zero Motorcycles",
            "Cagiva",
            "Gas Gas",
            "Bajaj",
            "TVS",
            "Hero MotoCorp",
            "KTM",
            "Mahindra",
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
            ]);
        }
    }
}
