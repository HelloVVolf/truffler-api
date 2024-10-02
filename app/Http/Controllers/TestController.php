<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
// use Illuminate\Foundation\Application;

class TestController extends Controller
{
    public function test()
    {
        // $app = env('APP_NAME');
        // return response()->json($app);

        return Tour::first()->category;
    }
}
