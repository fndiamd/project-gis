<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Dashboard\HomeController as DashboardHome;
use App\Http\Controllers\Dashboard\PlaceController as DashboardPlace;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardHome::class, 'index'])->name('index');
});

Route::name('place.')->prefix('place')->group(function(){
    Route::get('map-data', [DashboardPlace::class, 'mapData'])->name('map');
});

Route::get('/', function () {
    return view('front.index');
});
