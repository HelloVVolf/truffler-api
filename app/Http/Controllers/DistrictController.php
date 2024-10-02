<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    function index()
    {
        $districts = District::with('subdistricts')->get();

        return response()->json($districts);
    }

    function show($id)
    {
        $district = District::with('subdistricts')->findOrFail($id);

        return response()->json($district);
    }
}
