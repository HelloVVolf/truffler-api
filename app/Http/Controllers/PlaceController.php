<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Place;
use App\Models\PlaceCategory;
use App\Models\PlaceImage;
use App\Models\Subdistrict;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $places = Place::with('images', 'subdistrict')->get()->map(function ($place) {
        //     $place->setRelation('place_images', $place->images->take(1));
        //     return $place;
        // });

        // return response()->json($places);
        $search = $request->query('query');
        $location_type = $request->query('type');
        $location_id = $request->query('id');
        $category_id = $request->query('category');
        $places = Place::with('image', 'subdistrict.district.city', 'category');

        $places->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        if ($location_type == 'city') {
            $places->whereHas('subdistrict.district.city', function ($query) use ($location_id) {
                $query->where('city_id', '=', $location_id);
            });
        } elseif ($location_type == 'district') {
            $places->whereHas('subdistrict.district.city', function ($query) use ($location_id) {
                $query->where('district_id', '=', $location_id);
            });
        } elseif ($location_type == 'subdistrict') {
            $places->where('subdistrict_id', '=', $location_id);
        }

        $places->when($category_id, function ($query) use ($category_id) {
            $query->where('place_category_id', $category_id);
        });

        $places = $places->paginate(10);

        $params = $request->query();

        // $places->getCollection()->transform(function ($place) {
        //     $place->setRelation('place_images', $place->images->take(1));
        //     return $place;
        // });
        return response()->json($places);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());

        $request->validate([
            'name' => 'required|string|max:32',
            'category' => 'required',
            'open_time' => 'required|date_format:Y-m-d H:i:s',
            'closed_time' => 'required|date_format:Y-m-d H:i:s',
            'location' => 'required',
        ]);
        // return response()->json($request->all());

        $place = Place::create([
            'name' => $request->input('name'),
            'place_category_id' => $request->input('category'),
            'subdistrict_id' => $request->input('location'),
            'open_time' => Carbon::parse($request->input('open_time')),
            'closed_time' => Carbon::parse($request->input('closed_time')),
            'about' => $request->input('about'),
        ]);

        if ($request->file('images')) {

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('images/places', 'public');
                $place->images()->create([
                    'path' => 'storage/' . $path,
                ]);
            }
        }


        return response()->json(['message' => 'Place created successfully', 'data' => $place]);
    }



    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $place = Place::with('images', 'image', 'category', 'subdistrict.district.city')
            ->where('slug', $slug)
            ->first();

        if (!$place) {
            return response()->json(['error' => 'Place not found'], 404);
        }

        // $place->setRelation('place_images', $place->images->take(5));


        $arounds = Place::with('images', 'category')->where('subdistrict_id', $place->subdistrict_id)
            ->where('slug', '!=', $place->slug)->inRandomOrder('slug')
            ->paginate(3);

        $arounds->getCollection()->transform(function ($around) {
            $around->setRelation('place_images', $around->images->take(1));
            return $around;
        });

        return response()->json(['place' => $place, 'around' => $arounds], 200);
    }

    public function filter(Request $request)
    {
        // Find the type by ID
        // $request = $request->all();
        // return response()->json($request);
        // $places = Place::class;
        $search = $request->input('query');
        $location_type = $request->input('location_type');
        $location_id = $request->input('location_id');
        $category = $request->input('category_id');

        $places = Place::with('subdistrict.district.city', 'image', 'category')->inRandomOrder('slug');

        if ($location_type == 'city') {
            $places->whereHas('subdistrict.district.city', function ($query) use ($location_id) {
                $query->where('city_id', '=', $location_id);
            });
        } elseif ($location_type == 'district') {
            $places->whereHas('subdistrict.district.city', function ($query) use ($location_id) {
                $query->where('district_id', '=', $location_id);
            });
        } elseif ($location_type == 'subdistrict') {
            $places->where('subdistrict_id', '=', $location_id);
        }

        // $places->where('place_category_id', '=', $request->input('category_id'));
        $places->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });
        $places->when($category, function ($query) use ($category) {
            $query->where('place_category_id', $category);
        });

        $places = $places->paginate(10);

        return response()->json($places);
        // return response()->json($request->all(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $place = Place::with('images', 'category', 'subdistrict.district.city')
            ->where('slug', $slug)
            ->first();

        if (!$place) {
            return response()->json(['error' => 'Place not found'], 404);
        }

        $categories = PlaceCategory::all();

        $subDistrict = $place->subdistrict;
        $district = $subDistrict->district;
        $city = $district->city;

        $region = [
            'cities' => [
                'data' => City::all(),
                'selected' => $city
            ],
            'districts' => [
                'data' => $city->districts,
                'selected' => $district
            ],
            'subDistricts' => [
                'data' => $district->subdistricts,
                'selected' => $subDistrict
            ]
        ];

        return response()->json([
            'place' => $place,
            'categories' => $categories,
            'region' => $region
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $data = $request->all();
        // return response()->json($request);
        // return response()->json($request->input('images'));

        $request->validate([
            'name' => 'required|string|max:32',
            'category' => 'required',
            'open_time' => 'required|date_format:Y-m-d H:i:s',
            'closed_time' => 'required|date_format:Y-m-d H:i:s',
            'location' => 'required',
        ]);
        // return response()->json($request->all());
        $place = $place::findOrFail($data['id']);
        $place->update([
            'name' => $data['name'],
            'place_category_id' => $data['category'],
            'subdistrict_id' => $data['location'],
            'open_time' => Carbon::parse($data['open_time']),
            'closed_time' => Carbon::parse($data['closed_time']),
            'about' => $data['about'],
        ]);

        $existingImagesId = collect($data['images'])->pluck('id')->filter(); // Get IDs of existing durations present in the request
        $place->images()->whereNotIn('id', $existingImagesId)->delete();
        foreach ($data['images'] as $index => $imageData) {
            if (isset($imageData['id'])) {
                // If the image data contains an ID, it means it's an existing image
                $placeImage = PlaceImage::findOrFail($imageData['id']);

                // Check if the image data contains a new file
                if (!empty($imageData['file'])) {
                    // Store the new file
                    $path = $imageData['file']->store('images/places', 'public');

                    // Update the existing tour image file path
                    $placeImage->update([
                        'path' => 'storage/' . $path,
                    ]);
                }
            } else {
                // If the image data does not contain an ID, it means it's a new image
                if (!empty($imageData['file'])) {
                    // Store the new file
                    $path = $imageData['file']->store('images/places', 'public');

                    // Create a new tour image for the tour
                    $place->images()->create([
                        'path' => 'storage/' . $path,
                    ]);
                }
            }
        }

        return response()->json($place);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
