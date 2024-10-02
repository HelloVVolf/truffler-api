<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\PlaceImage;
use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourDay;
use App\Models\TourDayDuration;
use App\Models\TourImage;
use App\Models\TourPrice;
use App\Models\TourTag;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function filter(Request $request)
    {
        // return response()->json($request->all());
        $tours = Tour::with('prices', 'images', 'category')->withCount('orders', 'reviews')->withAvg('reviews', 'value')->orderBy('orders_count', 'desc')->paginate(10);

        foreach ($tours as $tour) {
            $lowestPrice = null;
            foreach ($tour['prices'] as $price) {
                if ($lowestPrice === null || $price['initial_price'] < $lowestPrice) {
                    $lowestPrice = $price['initial_price'];
                }
            }
            $tour['price'] = $lowestPrice;
        }

        return response()->json($tours);
    }

    public function create()
    {
        $categories = TourCategory::all();
        $tags = TourTag::get()->take(5);
        $response = [
            'categories' => $categories,
            'tags' => $tags,
        ];
        return response()->json($response, 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // return response()->json($data);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'about' => 'nullable|string',
            'benefit' => 'nullable|string',
            'info' => 'nullable|string',
            'acessibility' => 'nullable|string',
            'prices.*.initial_price' => 'required|numeric|gt:0|lt:99999999',
            'prices.*.max_participant' => 'required|numeric|gt:0|lt:99',
            'days' => 'required|array',
            'days.data.*.*.place_id' => 'required',
            'days.data.*.*.duration' => 'required|numeric|gt:0|',
            'days.data.*.*.order' => 'required|numeric',
            'images' => 'required|array',
        ], [
            // 'image.max' => 'This price',
            'days.data.*.*.duration.gt' => 'The duration must be greater than 0 minute',
            // 'prices.*.amount.required' => 'This price amount field is required.',
        ]);

        $validator->setAttributeNames([
            'prices.*.amount' => 'price',
            'prices.*.max' => 'pax',
            'day.*.*.place_id' => 'place field',
            'day.*.*.duration' => 'duration',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $structuredErrors = null;

            foreach ($errors as $field => $errorMessages) {
                $fieldParts = explode('.', $field);
                if ($fieldParts[0] === 'day' || $fieldParts[0] === 'prices') {
                    foreach ($errorMessages as $place) {
                        $key = $fieldParts[0];
                        $index = $fieldParts[1];
                        $subIndex = $fieldParts[2];
                        if (isset($fieldParts[3])) {
                            $subSubIndex = $fieldParts[3];
                            $structuredErrors[$key][$index][$subIndex][$subSubIndex] = $errorMessages;
                        } else {
                            $structuredErrors[$key][$index][$subIndex] = $errorMessages;
                        }
                    }
                } else {
                    $structuredErrors[$field] = $errorMessages;
                }
            }

            // Return errors
            return response()->json($structuredErrors, 422);
        } else {
            $tour = Tour::create([
                'tour_category_id' => $data['category'],
                'name' => $request->input('name'),
                'about' => $request->input('about'),
                'benefit' => $request->input('benefit'),
                'info' => $request->input('info'),
                'acessibility' => $request->input('acessibility'),
                'age_min' => $request->input('min_age'),
                'age_max' => $request->input('max_age'),
            ]);

            if (isset($data['tags'])) {
                $tour->tags()->attach($data['tags']);
            } else {

                $tour->tags()->attach([]);
            }

            foreach ($data['images'] as $index => $imageData) {
                $path = $imageData['file']->store('images/tours', 'public');

                // Create a new tour image for the tour
                $tour->images()->create([
                    'path' => 'storage/' . $path,
                ]);
            };


            foreach ($request->input('prices') as $priceData) {
                $price = new TourPrice();

                $price->name = $priceData['name'];
                $price->details = $priceData['details'];
                $price->initial_price = $priceData['initial_price'];
                $price->max_participant = $priceData['max_participant'];
                $price->adult_price = $priceData['adult_price'];
                $price->child_price = $priceData['child_price'];
                $price->infant_price = $priceData['infant_price'];

                $tour->prices()->save($price);
            }

            // Create tour days for the tour
            foreach ($request->input('days') as $day) {
                $tourDay = new TourDay();
                $tourDay->tour_id = $tour->id;
                $tourDay->save();

                foreach ($day['data'] as $dayData) {

                    // Attach durations to the tour day
                    $duration = new TourDayDuration([
                        'place_id' => $dayData['place_id'],
                        'duration' => $dayData['duration'],
                        'order' => $dayData['order'],
                    ]);

                    $tourDay->durations()->save($duration);
                }
            }

            return response()->json(['message' => 'Tour created successfully'], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $tour = Tour::with('images', 'prices', 'category', 'days.durations.place.subdistrict.district.city', 'days.durations.place.image', 'days.durations.place.category')->where('slug', $slug)->first();

        if (!$tour) {
            // Handle the case where the tour with the given slug is not found
            return response()->json(['error' => 'Tour not found'], 404);
        }

        $lowestPrice = null;

        foreach ($tour['prices'] as $price) {
            if ($lowestPrice === null || $price['initial_price'] < $lowestPrice) {
                $lowestPrice = $price['initial_price'];
                $tour['price'] = ['amount' => $lowestPrice, 'max' => $price['max_participant']];
            }
        }

        $tour->order = [
            'count' => $tour->orders->count()
        ];

        $tour->review = [
            'average' => $tour->reviews->avg('value'),
            'count' => $tour->reviews->count()
        ];



        return response()->json($tour, 200);
    }

    public function edit($slug)
    {


        $tour = Tour::with('images', 'prices', 'tags', 'days.durations.place.subdistrict.district.city', 'days.durations.place.image', 'days.durations.place.category')->where('slug', $slug)->first();

        if (!$tour) {
            // Handle the case where the tour with the given slug is not found
            return response()->json(['error' => 'Tour not found'], 404);
        }

        $lowestPrice = null;

        foreach ($tour['prices'] as $price) {
            if ($lowestPrice === null || $price['price'] < $lowestPrice) {
                $lowestPrice = $price['price'];
                $tour['price'] = ['amount' => $lowestPrice, 'max' => $price['max_participant']];
            }
        }

        $tour->order = [
            'count' => $tour->orders->count()
        ];

        $tour->review = [
            'average' => $tour->reviews->avg('value'),
            'count' => $tour->reviews->count()
        ];

        $categories = TourCategory::all();

        $tourTagsId = $tour->tags()->get()->pluck('id');
        $tags = TourTag::whereNotIn('id', $tourTagsId)->get()->take(5);

        $response = [
            'categories' => $categories,
            'tags' => $tags,
            'tour' => $tour,
        ];
        return response()->json($response, 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $data = $request->all();
        // return response()->json($data);

        $tour = Tour::where('slug', $slug)->first();
        $tour->update([
            'name' => $data['name'],
            'about' => $data['about'],
            'tour_category_id' => $data['category'],
            'benefit' => $data['benefit'],
            'info' => $data['info'],
            'acessibility' => $data['acessibility'],
            'age_min' => $data['min_age'],
            'age_max' => $data['max_age'],
        ]);

        if (isset($data['tags'])) {
            $tour->tags()->sync($data['tags']);
        } else {
            $tour->tags()->sync([]);
        }

        $existingPricesId = collect($data['prices'])->pluck('id')->filter(); // Get IDs of existing durations present in the request
        $tour->prices()->whereNotIn('id', $existingPricesId)->delete();

        foreach ($data['prices'] as $price) {
            $tourPrice = null;

            if (isset($price['id'])) {
                $tourPrice = TourPrice::find($price['id']); // Find the existing tour day by ID
            }

            if (!$tourPrice) {
                // If no ID is provided or no existing tour day found, create a new tour day
                $tourPrice = new TourPrice();
            }

            // Set properties
            $tourPrice->name = $price['name'];
            $tourPrice->details = $price['details'];
            $tourPrice->initial_price = $price['initial_price'];
            $tourPrice->max_participant = $price['max_participant'];
            $tourPrice->adult_price = $price['adult_price'] ?? null;
            $tourPrice->child_price = $price['child_price'] ?? null;
            $tourPrice->infant_price = $price['infant_price'] ?? null;

            $tourPrice->save();
        }

        $existingDayId = collect($data['days'])->pluck('id')->filter(); // Get IDs of existing durations present in the request
        $tour->days()->whereNotIn('id', $existingDayId)->delete();
        foreach ($data['days'] as $dayData) {
            if (isset($dayData['id'])) {
                $tourDay = TourDay::find($dayData['id']); // Find the existing tour day by ID
                if (!$tourDay) {
                    continue; // Skip if the tour day doesn't exist
                }
            } else {
                // If no ID is provided, create a new tour day
                $tourDay = $tour->days()->create([]);
            }
            // return response()->json($data, 200);
            $existingDurationIds = collect($dayData['data'])->pluck('id')->filter(); // Get IDs of existing durations present in the request
            $tourDay->durations()->whereNotIn('id', $existingDurationIds)->delete();

            // Update or create tour day durations for the day
            foreach ($dayData['data'] as $durationData) {
                if (isset($durationData['id'])) {
                    // If duration has an ID, find the existing duration by ID
                    $tourDayDuration = TourDayDuration::find($durationData['id']);
                    if (!$tourDayDuration) {
                        continue; // Skip if the tour day duration doesn't exist
                    }
                } else {
                    // If no ID is provided, create a new tour day duration
                    $tourDayDuration = new TourDayDuration();
                }

                // Update tour day duration fields
                // $tourDayDuration->fill($durationData);
                $tourDayDuration->place_id = $durationData['place_id'];
                $tourDayDuration->duration = $durationData['duration'];
                $tourDayDuration->order = $durationData['order'];
                $tourDayDuration->tour_day_id = $tourDay->id;
                $tourDayDuration->save();
            }
        }

        $existingImagesId = collect($data['images'])->pluck('id')->filter(); // Get IDs of existing durations present in the request
        $tour->images()->whereNotIn('id', $existingImagesId)->delete();
        foreach ($data['images'] as $index => $imageData) {
            if (isset($imageData['id'])) {
                // If the image data contains an ID, it means it's an existing image
                $tourImage = TourImage::findOrFail($imageData['id']);

                // Check if the image data contains a new file
                if (!empty($imageData['file'])) {
                    // Store the new file
                    $path = $imageData['file']->store('images/tours', 'public');

                    // Update the existing tour image file path
                    $tourImage->update([
                        'path' => 'storage/' . $path,
                    ]);
                }
            } else {
                // If the image data does not contain an ID, it means it's a new image
                if (!empty($imageData['file'])) {
                    // Store the new file
                    $path = $imageData['file']->store('images/tours', 'public');

                    // Create a new tour image for the tour
                    $tour->images()->create([
                        'path' => 'storage/' . $path,
                    ]);
                }
            }
        }


        // return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $tour = Tour::where('slug', $slug)->first();
        if (!$tour) {
            return response()->json(['message' => 'Tour not found'], 404);
        } else {
            $tour->delete();
            return response()->json(['message' => 'Tour deleted successfully'], 200);
        }
    }
}
