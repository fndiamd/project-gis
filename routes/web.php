<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Dashboard\HomeController as DashboardHome;
use App\Http\Controllers\Dashboard\PlaceController as DashboardPlace;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategory;

use App\Http\Controllers\Front\HomeController;
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
    Route::get('/', [DashboardPlace::class, 'index'])->name('index');

    Route::name('place.')->prefix('place')->group(function () {
        Route::get('/', [DashboardPlace::class, 'index'])->name('index');
        Route::get('/{id}/detail', [DashboardPlace::class, 'detail'])->name('detail');
        Route::get('/create', [DashboardPlace::class, 'create'])->name('create');
        Route::post('/store', [DashboardPlace::class, 'store'])->name('store');
        Route::post('/update', [DashboardPlace::class, 'update'])->name('update');
        Route::get('/{id}/delete', [DashboardPlace::class, 'delete'])->name('destroy');
    });

    Route::name('category.')->prefix('category')->group(function () {
        Route::get('/', [DashboardCategory::class, 'index'])->name('index');
        Route::get('/{id}/detail', [DashboardCategory::class, 'detail'])->name('detail');
        Route::get('/create', [DashboardCategory::class, 'create'])->name('create');
        Route::post('/store', [DashboardCategory::class, 'store'])->name('store');
        Route::post('/update', [DashboardCategory::class, 'update'])->name('update');
        Route::get('/{id}/delete', [DashboardCategory::class, 'delete'])->name('destroy');
    });
});

Route::name('place.')->prefix('place')->group(function () {
    Route::get('map-data', [DashboardPlace::class, 'mapData'])->name('map');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
