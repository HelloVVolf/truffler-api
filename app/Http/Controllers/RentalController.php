<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Rental;
use App\Models\Price;
use App\Models\RentalBrand;
use App\Models\RentalType;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    // Index
    public function index()
    {
        $rentals = Rental::with(['type', 'brand', 'prices'])->paginate(10);
        return response()->json($rentals);
    }



    // Search
    public function search(Request $request)
    {
        // $rentals = Rental::with(['type', 'prices'])->paginate(5);
        $query = $request->input('query');

        $rentals = Rental::with(['type', 'prices', 'brand'])->where('name', 'like', "%$query%")->paginate(10);

        // return response()->json($rentals);
        return response()->json($rentals);
    }



    // Create
    public function store(Request $request)
    {
        // $type = Type::findOrFail($request->input('type'));
        // $brand = RentalBrand::findOrFail($request->input('brand'));
        // return response()->json($request->all());

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            // 'brand' => 'required|number',
            'seat' => 'required|numeric',
            'luggage' => 'required|numeric',
            'door' => 'required|numeric',
            'prices' => 'required|array',
            'prices.*.amount' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.max' => 'This price',
            'prices.*.amount.required' => 'This price amount field is required.',
        ]);

        // Condition
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $structuredErrors = null;

            foreach ($errors as $field => $errorMessages) {
                $fieldParts = explode('.', $field);
                if ($fieldParts[0] === 'prices') {
                    $index = $fieldParts[1];
                    $structuredErrors['prices'][$index] = $errorMessages;
                } else {
                    $structuredErrors[$field] = $errorMessages;
                }
            }

            // Return errors
            return response()->json(['errors' => $structuredErrors], 422);
        } else {
            $type = Type::findOrFail($request->input('type'));
            $brand = Brand::findOrFail($request->input('brand'));

            // Store image
            // $request->file('image')->store('images/rentals', 'public');
            $imagePath = $request->file('image')->store('images/rentals', 'public');

            // Create rental
            $rental = new Rental([
                'name' => $request->input('name'),
                'type_id' => $request->input('type'),
                'brand_id' => $request->input('brand'),
                'seat' => $request->input('seat'),
                'luggage' => $request->input('luggage'),
                'door' => $request->input('door'),
                'transmission' => $request->input('transmission'),
                'fuel' => $request->input('fuel'),
                'imagePath' => 'storage/' . $imagePath,
            ]);
            $rental->save();

            // $type->rentals()->save($rental);
            // $brand->rentals()->save($rental);

            foreach ($request->input('prices') as $priceData) {
                $price = new Price([
                    'duration' => $priceData['duration'],
                    'amount' => $priceData['amount'],
                ]);

                $rental->prices()->save($price);
            }

            return response()->json([['message' => 'Data submitted successfully', 'data' => $rental]], 201);
        }
    }



    // Show
    public function show($id)
    {
        $rental = Rental::with(['prices' => function ($query) {
            $query->where('amount', '>', 0); // Assuming 'amount' is the column you want to check
        }, 'brand'])->findOrFail($id);

        return response()->json($rental, 200);
    }

    public function showBySlug($slug)
    {
        $rental = Rental::with(['prices' => function ($query) {
            $query->where('amount', '>', 0);
        }, 'type', 'brand'])
            ->where('slug', $slug)
            ->first();

        if (!$rental) {
            return response()->json(['error' => 'Rental not found'], 404);
        }

        return response()->json($rental, 200);
    }



    // Filter
    public function filter(Request $request)
    {
        // Find the type by ID
        // return response()->json($request->all(), 200);
        $search = $request->input('query');
        $type = $request->input('type');
        $seat = $request->input('seat');
        $luggage = $request->input('luggage');
        $brand = $request->input('brand');
        $fuel = $request->input('fuel');
        $transmission = $request->input('transmission');

        $rentals = Rental::with("price", "type", "brand")
            // ->where($search, function ($query) use ($search) {
            //     $query->where('name', 'like', "%$search%");
            // })

            ->where(function ($query) use ($seat, $luggage, $search, $fuel) {
                $query->where('seat', '>=', $seat)
                    ->where('luggage', '>=', $luggage)
                    ->where('name', 'like', "%$search%")
                    // ->where('fuel', $fuel)
                ;
            })
            ->when($type, function ($query) use ($type) {
                $query->whereHas('type', function ($subQuery) use ($type) {
                    $subQuery->where('id', $type);
                });
            })
            ->when($brand, function ($query) use ($brand) {
                $query->whereHas('brand', function ($subQuery) use ($brand) {
                    $subQuery->where('id', $brand);
                });
            })
            ->when($fuel, function ($query) use ($fuel) {
                $query->where('fuel', $fuel);
            })
            ->when($transmission, function ($query) use ($transmission) {
                $query->where('transmission', $transmission);
            })

            ->paginate(10);


        // // Retrieve all rentals for the given type

        // // Alternatively, you can use the relationship:
        // // $rentals = $type->rentals;

        // // Do something with the filtered rentals

        return response()->json($rentals, 200);
    }

    public function paginator(Request $request)
    {
        return response()->json($request->all());
    }

    // Update
    public function update(Request $request, $slug)
    {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            // 'brand' => 'required|number',
            'seat' => 'required|numeric',
            'luggage' => 'required|numeric',
            'door' => 'required|numeric',
            'prices' => 'required|array',
            // 'prices.*.amount' => 'required|numeric',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.max' => 'This price',
            'prices.*.amount.required' => 'This price amount field is required.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $structuredErrors = null;

            foreach ($errors as $field => $errorMessages) {
                $fieldParts = explode('.', $field);
                if ($fieldParts[0] === 'prices') {
                    $index = $fieldParts[1];
                    $structuredErrors['prices'][$index] = $errorMessages;
                } else {
                    $structuredErrors[$field] = $errorMessages;
                }
            }

            return response()->json(['errors' => $structuredErrors], 422);
        } else {
            $rental = Rental::where('slug', $slug)->first();
            $rental->update([
                'name' => $request->input('name'),
                'type_id' => $request->input('type'),
                'brand_id' => $request->input('brand'),
                'seat' => $request->input('seat'),
                'luggage' => $request->input('luggage'),
                'door' => $request->input('door'),
                'transmission' => $request->input('transmission'),
                'fuel' => $request->input('fuel'),
                // 'imagePath' => 'storage/' . $imagePath,
            ]);

            if ($request->file('image')) {
                $imagePath = $request->file('image')->store('images/rentals', 'public');
                $rental->update([
                    'imagePath' => 'storage/' . $imagePath,
                ]);
            }

            $rental->save();

            $prices = $request->input(('prices'));

            foreach ($prices as $price) {
                if (isset($price['id'])) {
                    $rentalPrice = Price::find($price['id']);
                    $rentalPrice->update([
                        'amount' => $price['amount'] ?? 0,
                    ]);
                } else {
                    $newPrice = new Price([
                        'duration' => $price['duration'],
                        'amount' => $price['amount'] ?? 0,
                    ]);

                    $rental->prices()->save($newPrice);
                }
                // return response()->json($price, 200);
            }

            return response()->json(["message" => "Rental updated successfully", "data" => $rental], 200);
        }
    }



    // Delete
    public function delete($slug)
    {
        $rental = Rental::where('slug', $slug)->first();
        if (!$rental) {
            return response()->json(['message' => 'Rental not found'], 404);
        } else {
            $rental->prices()->delete();
            $rental->delete();
            return response()->json(['message' => 'Rental deleted successfully'], 200);
        }
    }

    public function edit($slug = null)
    {
        $rental = $slug;
        if ($slug) {
            $rental = Rental::with('prices', 'brand', 'type')->where('slug', $slug)->first();
        }
        $brands = Brand::all();
        $types = Type::all();
        // return response()->json($id, 200);
        return response()->json(['brands' => $brands, 'types' => $types, 'rental' => $rental], 200);
    }
}
