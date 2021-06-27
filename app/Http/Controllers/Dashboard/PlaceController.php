<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Place;

class PlaceController extends Controller
{
    public function mapData(Request $request)
    {
        if (isset($request->category_id)) {
            $places = Place::whereIn('category_id', $request->category_id)->get();
        }else{
            $places = Place::get();
        }
        return json_encode($places);
    }
}
