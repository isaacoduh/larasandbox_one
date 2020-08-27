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
    return view('index');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/github/{username}', function($username){
    // Setup Guzzle client to interact with api
    // https://api.github.com/users/isaacoduh/events/public
    // https://www.itsolutionstuff.com/post/laravel-6-guzzle-http-client-exampleexample.html

    $client = new \GuzzleHttp\Client();
    $request = $client->request('GET',"https://api.github.com/users/".$username."/events/public", ['verify' => false]);
    $response = $request->getBody();

    $data = json_decode($response->getContents());
    $collection = collect($data);
    $grouped = $collection->mapToGroups(function($item, $key){
        return [$item['type'] => $item['id']];
    });
    dd($grouped);
    // $collection->count();
    // dd($collection->toArray());
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function(){
    Route::get('/links', 'LinkController@index');
    Route::get('/links/new', 'LinkController@create');
    Route::post('/links/new', 'LinkController@store');
    Route::get('/links/{link}', 'LinkController@edit');
    Route::post('/links/{link}', 'LinkController@update');
    Route::delete('/links/{link}', 'LinkController@destroy');

    Route::get('/settings', 'UserController@edit');
    Route::post('/settings', 'UserController@update');
});

Route::post('/visit/{link}', 'VisitController@store');
Route::get('{user}', 'UserController@show');
