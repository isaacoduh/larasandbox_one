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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLogin')->name('login.admin');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegistrationForm')->name('register.admin');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');

Route::view('/home', 'home')->middleware('auth')->name('home');

Route::group(['middleware' => 'auth:admin'], function(){
    Route::view('/admin', 'admin');
});
