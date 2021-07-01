<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
class HomeController extends Controller
{
    public function index(){
        $data = [
            'categories' => Category::orderBy('id', 'desc')->get()
        ];

        return view('front.index', $data);
    }
}
