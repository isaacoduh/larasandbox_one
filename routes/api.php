<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Route::get('orderables', 'Api\OrderableController@index');
// Route::get('orderables/{id}', 'Api\OrderableController@show');

Route::apiResource('orderables', 'Api\OrderableController')->only(['index', 'show']);
Route::get('orderables/{orderable}/availability', 'Api\OrderableAvailabilityController')->name('orderables.availability.show');
