<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\RentalBrand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();

        return response()->json($brand);
    }

    public function filter()
    {
        $brand = Brand::has("rentals")->with("rentals")->get();
        return response()->json($brand);
    }
}
