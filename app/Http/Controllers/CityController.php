<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    function index()
    {
        $cities = City::all();

        return response()->json($cities);
    }

    function show($id)
    {
        $city = City::with('districts')->findOrFail($id);

        return response()->json($city);
    }

    public function filterAll()
    {
        $cities = City::with('districts.subdistricts')->get();

        $resultArray = [];
        $count = 0; // Counter to keep track of the number of records

        foreach ($cities as $city) {
            $resultArray[] = [
                'id' => $city->id,
                'name' => $city->name,
                'type' => 'city',
            ];
            $count++;

            foreach ($city->districts as $district) {
                $resultArray[] = [
                    'id' => $district->id,
                    'name' => $district->name,
                    'type' => 'district',
                ];
                $count++;

                foreach ($district->subdistricts as $subdistrict) {
                    $resultArray[] = [
                        'id' => $subdistrict->id,
                        'name' => $subdistrict->name,
                        'type' => 'subdistrict',
                    ];
                    $count++;

                    // Check if the count has reached 10, and exit the loop
                    if ($count >= 5) {
                        break 3; // Break out of all three nested loops
                    }
                }
            }
        }



        return response()->json($resultArray);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        if ($query) {
            $cities = City::orWhere('name', 'like', '%' . $query . '%')->get();
            $districts = District::orWhere('name', 'like', '%' . $query . '%')->get();
            $subdistricts = Subdistrict::orWhere('name', 'like', '%' . $query . '%')->get();
        } else {
            $cities = City::inRandomOrder()
                ->limit(5)
                ->get();
            $districts = District::inRandomOrder()
                ->limit(5)
                ->get();
            $subdistricts = Subdistrict::inRandomOrder()
                ->limit(5)
                ->get();
        }

        $resultArray = [];
        $count = 0; // Counter to keep track of the number of records

        foreach ($cities as $city) {
            $resultArray[] = [
                'id' => $city->id,
                'name' => $city->name,
                'type' => 'city',
            ];
            $count++;
        }
        foreach ($districts as $district) {
            $resultArray[] = [
                'id' => $district->id,
                'name' => $district->name,
                'type' => 'district',
            ];
            $count++;
        }
        foreach ($subdistricts as $subdistrict) {
            $resultArray[] = [
                'id' => $subdistrict->id,
                'name' => $subdistrict->name,
                'type' => 'subdistrict',
            ];
            $count++;
        }

        $result = collect($resultArray)->shuffle()->toArray();
        $result = array_slice($result, 0, 5);

        return response()->json($result);
    }
}
