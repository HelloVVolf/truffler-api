<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Tour;
use App\Models\TourDay;
use App\Models\TourDayDuration;
use App\Models\TourImage;
use App\Models\TourPrice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tour_data = [
            [
                'name' => 'Bali All-in-One Tour: Temples, Lakes, Waterfall, and Rice Terraces',

                'about' => "Embark on a captivating journey through Bali's most iconic destinations with us. Immerse yourself in the spiritual tranquility of Ulun Danu Beratan Temple, marvel at the serene beauty of Tamblingan Lake, and feel the refreshing mist of Banyumala Twin Waterfall. Then, wander through the breathtaking landscapes of Jatiluwih Rice Terraces, before concluding your adventure with a mesmerizing sunset at the sacred Tanah Lot Temple. Prepare to be enchanted by the diverse wonders of Bali, where every moment is an unforgettable experience. Join us and create timeless memories on this extraordinary journey.",

                'benefit' => "<p><strong>Include</strong></p><ul><li><p>Pick up and drop off services</p></li><li><p>Bottled water</p></li><li><p>Private transportation</p></li><li><p>Air-conditioned vehicle</p></li><li><p>English speaking driver as a guide</p></li></ul><p></p><p><strong>Optional</strong></p><ul><li><p>Entrance fees</p></li><li><p>Activity tickets</p></li><li><p>Lunch</p></li></ul><p></p><p><strong>Exclude</strong></p><ul><li><p>Gratuities</p></li></ul>",

                'info' => '<ul><li><p>You will receive confirmation upon booking.</p></li><li><p>Most travelers can participate</p></li><li><p>This tour/activity is private to your group (no other participants will involved)</p></li></ul>',

                'acessibility' => '<ul><li><p>Not wheelchair accessible</p></li><li><p>Not Stroller accessible</p></li></ul><p><br></p>',

                'image' => 'bali-all-in-one-tour',
                'day' => [
                    [
                        [
                            "name" => "Ulun Danu Beratan Temple",
                            "duration" => "90",
                            "order" => "0"
                        ],
                        [
                            "name" => "Tamblingan Lake",
                            "duration" => "30",
                            "order" => "1"
                        ],
                        [
                            "name" => "Banyumala Twin Waterfalls",
                            "duration" => "120",
                            "order" => "2"
                        ],
                        [
                            "name" => "Jatiluwih Rice Terraces",
                            "duration" => "120",
                            "order" => "3"
                        ],
                        [
                            "name" => "Tanah Lot",
                            "duration" => "60",
                            "order" => "4",
                        ],
                    ]
                ],
                'prices' => [
                    [
                        "name" => "Without Admission",
                        "details" => "Basic Package (price counted per vehicle)",
                        "initial_price" => 40,
                        "max" => 6
                    ],
                    [
                        "name" => "All Inclusive",
                        "details" => "Include admissions and lunch (price counted per person)",
                        'initial_price' => 40,
                        'adult_price' => 25,
                        'child_price' => 22,
                        'infant_price' => 0,
                        "max" => 6
                    ],
                ],
                'time_min' => "06:00:00",
                'time_max' => "07:30:00",
                'age_min' => 1,
                'age_max' => 99,
            ],
            [
                'name' => 'Bali Instagram Tour: The Most Famous Spots',

                'about' => "Calling all Instagram enthusiasts! Embark on an unforgettable journey through Bali's most picturesque spots with our exclusive private tour designed just for you. Say goodbye to the hassle of holding up a tour group – on our private trip, the focus is solely on capturing those perfect Instagram shots while you explore iconic locations such as the mesmerizing Lempuyang Temple and the stunning Tegalalang Rice Terrace. Relax and let us cater to your photography needs, ensuring every moment is picture-perfect. Don't miss out on this opportunity to elevate your Instagram game and create envy-inducing memories. Book your adventure today and prepare to dazzle your followers!",

                'benefit' => "<p><strong>Include</strong></p><ul><li><p>Pick up and drop off services</p></li><li><p>Bottled water</p></li><li><p>Private transportation</p></li><li><p>Air-conditioned vehicle</p></li><li><p>English speaking driver as a guide</p></li></ul><p></p><p><strong>Optional</strong></p><ul><li><p>Entrance fees</p></li><li><p>Activity tickets</p></li><li><p>Lunch</p></li></ul><p></p><p><strong>Exclude</strong></p><ul><li><p>Gratuities</p></li></ul>",

                'info' => '<ul><li><p>You will receive confirmation upon booking.</p></li><li><p>Most travelers can participate</p></li><li><p>This tour/activity is private to your group (no other participants will involved)</p></li></ul>',

                'acessibility' => '<ul><li><p>Not wheelchair accessible</p></li><li><p>Stroller accessible</p></li></ul><p><br></p>',

                'image' => 'bali-instagram-tour',
                'day' => [
                    [
                        [
                            "name" => "Lempuyang Temple",
                            "duration" => "60",
                            "order" => "0"
                        ],
                        [
                            "name" => "Tirta Gangga",
                            "duration" => "60",
                            "order" => "1"
                        ],
                        [
                            "name" => "Tukad Cepung Waterfall",
                            "duration" => "60",
                            "order" => "2"
                        ],
                        [
                            "name" => "Bali Pulina",
                            "duration" => "60",
                            "order" => "3",
                            "optional" => true,
                        ],
                        [
                            "name" => "Tegallalang",
                            "duration" => "60",
                            "order" => "4",
                        ]
                    ]
                ],
                'prices' => [
                    [
                        "name" => "Without Admission",
                        "details" => "Basic Package (price counted per vehicle)",
                        "initial_price" => 40,
                        "max" => 6
                    ],
                    [
                        "name" => "All Inclusive",
                        "details" => "Include admissions and lunch (price counted per person)",
                        'initial_price' => 40,
                        'adult_price' => 25,
                        'child_price' => 22,
                        'infant_price' => 0,
                        "max" => 6
                    ],
                ],
                'time_min' => "06:00:00",
                'time_max' => "08:00:00",
                'age_min' => 1,
                'age_max' => 99,
            ],
            [
                'name' => 'Full Day Tour: All The Best of Ubud',

                'about' => "Experience the magic of Ubud like never before with our exclusive private tours! Tailor your adventure to your desires and immerse yourself in the wonders of this enchanting destination. Beat the heat in style with our luxurious air-conditioned cars while our expert guides share their insider knowledge, ensuring an unforgettable journey. From the breathtaking Tegalalang Rice Terrace to the awe-inspiring Tegenungan Waterfall and the captivating Sacred Monkey Forest Sanctuary, let us take you on an extraordinary exploration of Ubud's finest attractions. Book your adventure today and make memories that will last a lifetime!",

                'benefit' => "<p><strong>Include</strong></p><ul><li><p>Pick up and drop off services</p></li><li><p>Bottled water</p></li><li><p>Private transportation</p></li><li><p>Air-conditioned vehicle</p></li><li><p>English speaking driver as a guide</p></li></ul><p></p><p><strong>Optional</strong></p><ul><li><p>Entrance fees</p></li><li><p>Activity tickets</p></li><li><p>Lunch</p></li></ul><p></p><p><strong>Exclude</strong></p><ul><li><p>Gratuities</p></li></ul>",

                'info' => '<ul><li><p>You will receive confirmation upon booking.</p></li><li><p>Most travelers can participate</p></li><li><p>This tour/activity is private to your group (no other participants will involved)</p></li></ul>',

                'acessibility' => '<ul><li><p>Not wheelchair accessible</p></li><li><p>Stroller accessible</p></li></ul><p><br></p>',

                'image' => 'best-of-ubud-tour',

                'day' => [
                    [
                        [
                            "name" => "Campuhan Ridge Walk",
                            "duration" => "60",
                            "optional" => true,
                            "order" => "0"
                        ],
                        [
                            "name" => "Monkey Forest",
                            "duration" => "90",
                            "order" => "1"
                        ],
                        [
                            "name" => "Tirta Empul Temple",
                            "duration" => "90",
                            "order" => "2"
                        ],
                        [
                            "name" => "Tegallalang",
                            "duration" => "120",
                            "order" => "3"
                        ],
                        [
                            "name" => "Tegenungan Waterfall",
                            "duration" => "60",
                            "order" => "4"
                        ]
                    ]
                ],
                'time_min' => "06:00:00",
                'time_max' => "10:00:00",
                'prices' => [
                    [
                        "name" => "Without Admission",
                        "details" => "Basic Package (price counted per vehicle)",
                        "initial_price" => 40,
                        "max" => 6
                    ],
                    [
                        "name" => "All Inclusive",
                        "details" => "Include admissions and lunch (price counted per person)",
                        'initial_price' => 40,
                        'adult_price' => 25,
                        'child_price' => 22,
                        'infant_price' => 0,
                        "max" => 6
                    ],
                ],
                'age_min' => 1,
                'age_max' => 99,
            ],


        ];

        foreach ($tour_data as $data) {

            $tour = new Tour([
                'tour_category_id' => 1,
                'name' => $data['name'],
                'about' => $data['about'],
                'benefit' => $data['benefit'],
                'acessibility' => $data['acessibility'],
                'info' => $data['info'],
                'time_min' => $data['time_min'],
                'time_max' => $data['time_max'],
                'age_min' => $data['age_min'],
                'age_max' => $data['age_max'],

            ]);
            $tour->save();

            $imageFolderPath = public_path('images/seeder/tours/' . $data['image']);

            if (File::isDirectory($imageFolderPath)) {
                $imageFiles = File::files($imageFolderPath);

                foreach ($imageFiles as $imageFile) {
                    $splFileInfo = new \SplFileInfo($imageFile);

                    $storedPath = 'images/seeder/tours/' . $data['image'] . '/' . $splFileInfo->getFilename();

                    $image = new TourImage([
                        'tour_id' => $tour->id,
                        'path' => $storedPath,
                    ]);

                    $image->save();
                }
            }

            foreach ($data['day'] as $dayData) {
                $tourDay = new TourDay();
                $tourDay->tour_id = $tour->id;
                $tourDay->save();

                foreach ($dayData as $durationData) {
                    $place = Place::where('name', 'like', "%{$durationData['name']}%")->first();
                    $duration = new TourDayDuration([
                        'place_id' => $place->id,
                        'duration' => $durationData['duration'],
                        'order' => $durationData['order'],
                        "optional" => $durationData['optional'] ?? false,
                    ]);

                    $tourDay->durations()->save($duration);
                }
            }

            foreach ($data['prices'] as $priceData) {
                $price = new TourPrice([
                    "name" => $priceData['name'],
                    "details" => $priceData['details'],
                    "initial_price" => $priceData['initial_price'],
                    'adult_price' => $priceData['adult_price'] ?? null,
                    'child_price' => $priceData['child_price'] ?? null,
                    'infant_price' => $priceData['infant_price']  ?? null,
                    'max_participant' => $priceData['max'],
                ]);

                $tour->prices()->save($price);
            }
        }
    }
}
