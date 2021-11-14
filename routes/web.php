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
Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');

// Main page
Route::get('/', 'MainController@index')->name('main');

// Only verified email
// Profile
Route::get('/account', 'AccountController@profile')->middleware('verified')->name('profile');
