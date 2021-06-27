<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Dashboard\HomeController as DashboardHome;
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

Route::get('/', function () {
    return view('welcome');
});
