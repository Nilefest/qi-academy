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

// Auth
// Auth::routes(['verify' => true]);
// Route::get('/logout', 'Auth\LoginController@logout');
// Route::get('/', function () {
//     return view('googleLogin');
// });
// Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
// Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

// Main page
// Route::get('/', 'MainController@index')->name('main');
// Route::get('/about', 'InfoController@about')->name('about');
// Route::get('/team', 'InfoController@team')->name('team');

// Only verified email
// Profile
// Route::get('/account', 'AccountController@profile')->middleware('verified')->name('profile');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



Route::get('/', function () {
    return view('main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/google', 'Auth\Socialite\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\Socialite\GoogleController@handleGoogleCallback');

Route::get('auth/facebook', 'Auth\Socialite\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\Socialite\FacebookController@handleFacebookCallback');