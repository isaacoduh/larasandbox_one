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
Route::get('orderables/{orderable}/reviews', 'Api\OrderableReviewController')->name('orderables.reviews.index');
Route::get('orderables/{orderable}/price', 'Api\OrderablePriceController')->name('orderables.price.show');
Route::get('/order-by-review/{reviewKey}', 'Api\OrderByReviewController')->name('order.by-review.show');
Route::apiResource('reviews', 'Api\ReviewController')->only(['show','store']);

Route::post('checkout', 'Api\CheckoutController')->name('checkout');
