<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Review;
use App\Models\Tour;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $params = $request->query();

        if ($params) {
            $type = $params['type'];
            $id = $params['id'];
            $value = $params['value'] ?? null;

            if ($type === "tour") {
                $reviews = Tour::where('slug', $id)->first()->reviews();
                if ($value) {

                    $reviews = $reviews->where('value', $value)->paginate(10);
                } else {

                    $reviews = $reviews->paginate(10);
                }
            } elseif ($type === "rental") {
                $reviews = Rental::where('slug', $id)->first()->reviews()->paginate(10);
            }
        } else {
            $reviews = Review::all();
        }
        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // return response()->json($data);
        // $date = $data['start_date'];
        // return response()->json($data);
        // return response()->json([Carbon::now(), Carbon::now()->utc()]);

        // $field = $request->validate([
        //     // 'start_date' => 'required|datetime',
        //     'name' => 'required|string',
        //     'email' => 'required|string|email',
        //     'phone' => 'required|string|regex:/^[0-9]{10,13}$/',
        //     'location' => 'required|string',
        //     'address' => 'required|string'
        // ]);


        $reviewData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'value' => $data['value'],
            'title' => $data['title'],
            'text' => $data['text'],
        ];

        if (isset($data['user_id'])) {
            $reviewData['user_id'] = $data['user_id'];
        } elseif (isset($data['session'])) {
            $reviewData['session'] = $data['session'];
        }

        $review = new Review($reviewData);

        if ($data['type'] === "tour") {
            $review->type()->associate(Tour::find($data['id']));
        } else {
            $review->type()->associate(Rental::find($data['id']));
        }

        $review->save();

        return response()->json($reviewData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
