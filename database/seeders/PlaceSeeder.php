<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\PlaceCategory;
use App\Models\PlaceImage;
use App\Models\Subdistrict;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PlaceSeeder extends Seeder
{

    public function run()
    {
        $places_data = [
            [
                'place_category_id' => 'Rice Terrace',
                'subdistrict_id' => 'Tegallalang',
                'name' => 'Tegallalang Rice Terrace',
                'image' => 'tegallalang-rice-terraces',
                'open_time' => "08:00:00",
                'closed_time' => "19:00:00",
                'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, distinctio?',
            ],
            [
                'place_category_id' => 'Wildlife',
                'subdistrict_id' => 'Ubud',
                'name' => 'Ubud Monkey Forest Sanctuary',
                'image' => 'ubud-monkey-forest',
                'open_time' => "09:00:00",
                'closed_time' => "017:00:00",
                'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, distinctio?',
            ],
            [
                'place_category_id' => 'Cafes',
                'subdistrict_id' => 'Ubud',
                'name' => 'Zest Ubud',
                'image' => 'zest-ubud',
                'open_time' => "08:00:00",
                'closed_time' => "22:00:00",
                'about' => 'Zen-like, bohemian outfit serving plant-based global fare made from locally sourced ingredients.',
            ],
            [
                'place_category_id' => 'Historical',
                'subdistrict_id' => 'Ubud',
                'name' => 'Goa Gajah Temple',
                'image' => 'goa-gajah-temple',
                'open_time' => "08:00:00",
                'closed_time' => "18:00:00",
                'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate, temporibus?',
            ],
            [
                'place_category_id' => 'Beach Club',
                'subdistrict_id' => 'Canggu',
                'name' => 'La Brisa',
                'image' => 'la-brisa',
                'open_time' => "10:00:00",
                'closed_time' => "23:00:00",
                'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, distinctio?',
            ],
            [
                'place_category_id' => 'Religious',
                'subdistrict_id' => 'Tampaksiring',
                'name' => 'Tirta Empul Temple',
                'image' => 'tirta-empul-temple',
                'open_time' => "10:00:00",
                'closed_time' => "22:00:00",
                'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, distinctio?',
            ],
            [
                'place_category_id' => 'Plantations',
                'subdistrict_id' => 'Sebatu',
                'name' => 'Bali Pulina',
                'image' => 'bali-pulina',
                'open_time' => "08:00:00",
                'closed_time' => "18:00:00",
                'about' => 'Sprawling venue with lush, tropical vegetation, coffee & tea tastings & a zipline through foliage.',
            ],
            [
                'place_category_id' => 'Religious Sites',
                'subdistrict_id' => 'Abang',
                'name' => 'Lempuyang Temple',
                'image' => 'lempuyang-temple',
                'open_time' => "06:00:00",
                'closed_time' => "19:00:00",
                'about' => 'Pura Penataran Agung Lempuyang is a Balinese Hindu temple or pura located in the slope of Mount Lempuyang in Karangasem, Bali. Pura Penataran Agung Lempuyang is considered as part of a complex of pura surrounding Mount Lempuyang, one of the highly regarded temples of Bali.',
            ],
            [
                'place_category_id' => 'Historical Sites',
                'subdistrict_id' => 'Abang',
                'name' => 'Tirta Gangga',
                'image' => 'tirta-gangga',
                'open_time' => "06:00:00",
                'closed_time' => "19:00:00",
                'about' => 'Tirta Gangga is a former royal palace in eastern Bali, Indonesia, about 5 kilometres from Karangasem, near Abang. Named after the sacred river Ganges in Hinduism, it is noted for the Karangasem royal water palace, bathing pools and its Patirthan temple.',
            ],
            [
                'name' => 'Campuhan Ridge Walk',
                'image' => 'campuhan-ridge-walk',
                'subdistrict_id' => 'Kelusa',
                'place_category_id' => 'Hiking Areas',
                'open_time' => "00:00:00",
                'closed_time' => "00:00:00",
                'about' => 'Lush, scenic locale known for its mellow hiking trails & sweeping hilltop views.',
            ],
            [
                'place_category_id' => 'Waterfalls',
                'subdistrict_id' => 'Kemenuh',
                'name' => 'Tegenungan Waterfall',
                'image' => 'tegenungan-waterfall',
                'open_time' => "00:00:00",
                'closed_time' => "00:00:00",
                'about' => 'Tegenungan Waterfall is a waterfall in Bali, Indonesia. It is located at the village of Tegenungan Kemenuh, also known as Kemenuh Village on the Petanu River in the Gianyar Regency, north from the capital Denpasar and close to the Balinese artist village of Ubud.',
            ],
            [
                'place_category_id' => 'Waterfalls',
                'subdistrict_id' => 'Tembuku',
                'name' => 'Tukad Cepung Waterfall',
                'image' => 'tukad-cepung-waterfall',
                'open_time' => "07:00:00",
                'closed_time' => "18:00:00",
                'about' => 'Waterfall tumbling through a cave opening, lit by shafts of sunlight & reached by a forest trail.',
            ],
            [
                'place_category_id' => 'Religious Sites',
                'subdistrict_id' => 'Candikuning',
                'name' => 'Ulun Danu Beratan Temple',
                'image' => 'ulun-danu-beratan-temple',
                'open_time' => "07:00:00",
                'closed_time' => "19:00:00",
                'about' => 'Pura Ulun Danu Beratan, or Pura Bratan, is a major Hindu Shaivite temple in Bali, Indonesia. The temple complex is on the shores of Lake Bratan in the mountains near Bedugul.',
            ],
            [
                'place_category_id' => 'Lakes',
                'subdistrict_id' => 'Munduk',
                'name' => 'Tamblingan Lake',
                'image' => 'tamblingan-lake',
                'open_time' => "00:00:00",
                'closed_time' => "00:00:00",
                'about' => 'Lake Tamblingan is a caldera lake located in Buleleng Regency, Bali. The lake is located at the foot of Mount Lesung in Munduk administrative village, Banjar subdistrict, Buleleng Regency, Bali, Indonesia.',
            ],
            [
                'place_category_id' => 'Waterfalls',
                'subdistrict_id' => 'Wanagiri',
                'name' => 'Banyumala Twin Waterfalls',
                'image' => 'banyumala-twin-waterfalls',
                'open_time' => "08:00:00",
                'closed_time' => "18:00:00",
                'about' => "Banyumala isn't just one twin waterfall but rather a cluster of numerous small waterfalls converging into a natural pool. It's a picturesque spot in Bali, ideal for a refreshing swim despite the chilly mountain water. During evening visits, solitude is often enjoyed, a welcome departure from the crowded Tukad Cepung waterfall. At the trail's end, there's a shelter and restroom for changing before diving in. Nearby, additional small waterfalls await exploration. The addition of vibrant flowers by locals enhances the area's natural beauty and offers ample opportunities for photography. Overall, Banyumala presents a serene retreat in northern Bali.",
            ],
            [
                'place_category_id' => 'Rice Terraces',
                'subdistrict_id' => 'Jatiluwih',
                'name' => 'Jatiluwih Rice Terraces',
                'image' => 'jatiluwih-rice-terraces',
                'open_time' => "08:00:00",
                'closed_time' => "18:00:00",
                'about' => "Scenic area with verdant, undulating rice terraces attracting hikers, cyclists & photographers.",
            ],
            [
                'place_category_id' => 'Points of Interest & Landmarks',
                'subdistrict_id' => 'Beraban',
                'name' => 'Tanah Lot',
                'image' => 'tanah-lot',
                'open_time' => "06:00:00",
                'closed_time' => "19:00:00",
                'about' => "Tanah Lot is a rock formation off the Indonesian island of Bali. It is home to the ancient Hindu pilgrimage temple Pura Tanah Lot, a popular tourist and cultural icon for photography.",
            ],
            // Add more rentals as needed
        ];

        foreach ($places_data as $place_data) {
            $category = PlaceCategory::where('name', 'like', "%{$place_data['place_category_id']}%")->first();
            $subdistrict = Subdistrict::where('name', '=', $place_data['subdistrict_id'])->first();

            if (!$category || !$subdistrict) {
                continue; // Skip if type or brand is not found
            }

            $place = new Place([
                'place_category_id' => $category->id,
                'subdistrict_id' => $subdistrict->id,
                'name' => $place_data['name'],
                'about' => $place_data['about'],
                'open_time' => $place_data['open_time'],
                'closed_time' => $place_data['closed_time'],
            ]);
            $place->save();

            $imageFolderPath = public_path('images/seeder/places/' . $place_data['image']);

            if (File::isDirectory($imageFolderPath)) {
                $imageFiles = File::files($imageFolderPath);

                foreach ($imageFiles as $imageFile) {
                    $splFileInfo = new \SplFileInfo($imageFile);

                    $storedPath = 'images/seeder/places/' . $place_data['image'] . '/' . $splFileInfo->getFilename();

                    $placeImage = new PlaceImage([
                        'place_id' => $place->id,
                        'path' => $storedPath,
                    ]);

                    $placeImage->save();
                }
            }
        }
    }
}
