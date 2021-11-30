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

// Auth
Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('auth/google', 'Auth\Socialite\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\Socialite\GoogleController@handleGoogleCallback');
Route::get('auth/facebook', 'Auth\Socialite\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\Socialite\FacebookController@handleFacebookCallback');
Route::get('/home', 'MainController@home')->name('home');

// Public
Route::get('/', 'MainController@index')->name('main');
Route::get('/about', 'InfoController@about')->name('about');
Route::get('/team', 'InfoController@team')->name('team');
Route::get('/course/{course_id}', 'CourseController@view')->name('course.view');
// Route::get('/personal-data-policy', 'InfoController@personal_data_policy')->name('course.view');
// Route::get('/public-offer', 'InfoController@public_offer')->name('course.view');
// Route::get('/payment-with-card', 'InfoController@payment_cart')->name('course.view');

// For Account
Route::get('/profile/{user_id?}', 'AccountController@profile')->name('account.profile');
Route::post('/profile/{user_id?}', 'AccountController@profile')->name('account.profile.post');
Route::get('/courses/{user_id?}', 'CourseController@list_account')->middleware('verified')->name('account.courses');
Route::get('/account/lecture/{lecture_id}', 'CourseController@lecture')->middleware('verified')->name('courses.lecture');

// For Admin
Route::get('/admin', 'AdminController@dashboard')->middleware('verified')->name('admin.dashboard');
Route::get('/admin/team', 'AdminController@team')->middleware('verified')->name('admin.team');
Route::post('/admin/team', 'AdminController@team')->middleware('verified')->name('admin.team.post');
Route::get('/admin/courses_offline', 'CourseOfflineController@list_admin')->middleware('verified')->name('admin.courses_offline');
Route::get('/admin/courses', 'CourseController@list_admin')->middleware('verified')->name('admin.courses');
Route::get('/admin/course/{course_id}', 'CourseController@edit')->middleware('verified')->name('admin.course.edit');

// For Testing
Route::get('/test', 'TestController@get')->name('test.get');
Route::post('/test', 'TestController@post')->name('test.post');
