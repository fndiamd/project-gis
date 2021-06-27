<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Place;

class PlaceController extends Controller
{
    public function mapData(){
        $places = Place::get();

        return json_encode($places);
    }
}
