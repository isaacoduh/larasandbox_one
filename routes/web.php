<?php

use App\Http\Controllers\TaskController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', [
    'uses' => 'TaskController@index',
    'as' => 'tasks.index'
]);

Route::group(['prefix' => 'tasks'], function () {
    Route::get('/{id}', [
        'uses' => 'TaskController@show',
        'as' => 'tasks.show'
    ]);
    Route::post('/', [
        'uses' => 'TaskController@store',
        'as'   => 'tasks.store',
    ]);

    Route::put('/{id}', [
        'uses' => 'TaskController@update',
        'as'   => 'tasks.update',
    ]);

    Route::delete('/{id}', [
        'uses' => 'TaskController@destroy',
        'as'   => 'tasks.destroy',
    ]);
});
