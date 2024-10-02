<?php

namespace App\Http\Controllers;

use App\Models\TourTag;
use Illuminate\Http\Request;

class TourTagController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $excludeIds = $request->query('exclude');

        if ($query !== null) {
            $tagsQuery = TourTag::where('name', 'like', '%' . $query . '%');
        } else {
            $tagsQuery = TourTag::query();
        }

        if ($excludeIds !== null) {
            $excludeIds = explode(',', $excludeIds);
            $tagsQuery->whereNotIn('id', $excludeIds);
        }

        $tags = $tagsQuery->get()->take(5);

        return response()->json($tags);
    }
}
