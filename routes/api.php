<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\WeatherEndPoint;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/v1')->group(function () {

    Route::prefix('/wheater')->group(function () {

        Route::get('/', [WeatherEndPoint::class, 'getAll']);
        Route::get('/{city}',[WeatherEndPoint::class, 'getCity']);

    });

    Route::get('/', function () {
        return response()->json([
            'message' => 'Please login to the API with username and password. Unauthenticated'
        ]);
    });

});

