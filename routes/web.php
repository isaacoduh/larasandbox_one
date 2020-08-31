<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('select')->name('select.')->group(function () {
    Route::post('states', 'ShopController@states')->name('states');
    Route::post('areas', 'ShopController@areas')->name('areas');
    Route::post('shps', 'ShopController@boards')->name('shops');
});


Route::get('/states', 'HomeController@states')->name('states');
Route::get('/areas', 'HomeController@areas')->name('areas');
