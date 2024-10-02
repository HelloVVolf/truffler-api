<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::with("rentals")->get();
        return response()->json($types);
    }

    public function filter()
    {
        $types = Type::has("rentals")->with("rentals")->get();
        return response()->json($types);
    }
}
