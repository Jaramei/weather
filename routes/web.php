<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use \App\Http\Controllers\WeatherVisualController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/weather')->group(function () {

    /** 1. Service: Simple Example */
    Route::get('/{city}',[WeatherController::class, 'index'])->where('city', '/\p{L}+/u');
    /** 2. Package: Visual only Output array dd() + string */
    Route::get('/visual/{city}',[WeatherVisualController::class, 'currentTemperature'])->where('city', '/\p{L}+/u');

});



