<?php

namespace App\Http\Controllers;

use App\Models\PlaceCategory;
use Illuminate\Http\Request;

class PlaceCategoryController extends Controller
{
    public function index()
    {
        $category = PlaceCategory::all();
        return response()->json($category);
    }

    public function show($id)
    {
        $category = PlaceCategory::findOrFail($id);
        $category->load('places');
        return response()->json($category);
    }
}
