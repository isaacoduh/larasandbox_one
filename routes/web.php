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

Route::view('/', function(){
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

/*** Admin Routes */
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::namespace('Auth')->group(function(){
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        // Register Routes

        // Forgot Password Routes
        Route::get('/password/reset', 'ForgotPassword@showLinkRequestForm')->name('password.request');
        Route::post('/password/reset', 'ForgotPassword@sendResetLinkEmail')->name('password.email');

        // Reset Password Routes
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

        // Email Verification Route(s)
        Route::get('email/verify', 'VerifyController@show')->name('verification.notice');
        Route::get('email/verify/{id}', 'VerifyController@verify')->name('verification.verify');
        Route::get('email/resend', 'VerifyController@resend')->name('verification.resend');
    });
    Route::get('/dashboard','HomeController@index')->name('home')->middleware('guard.verified:admin,admin.verification.notice');
    // Admin Routes go here
});
/** /Admin Routes */

