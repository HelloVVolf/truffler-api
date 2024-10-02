<?php

namespace App\Http\Controllers;

use App\Models\TourCategory;
use Illuminate\Http\Request;

class TourCategoryController extends Controller
{
    public function index()
    {
        $categories = TourCategory::all();
        return response()->json($categories, 200);
    }
}
