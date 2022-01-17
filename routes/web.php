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
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('auth/google', 'Auth\Socialite\GoogleController@redirectToGoogle')->name('auth.google');
Route::get('auth/google/callback', 'Auth\Socialite\GoogleController@handleGoogleCallback')->name('auth.google.callback');
Route::get('auth/facebook', 'Auth\Socialite\FacebookController@redirectToFacebook')->name('auth.facebook');
Route::get('auth/facebook/callback', 'Auth\Socialite\FacebookController@handleFacebookCallback')->name('auth.facebook.callback');
// Route::get('/auth/check', function () { return Auth::check() * 1; })->name('auth.check');
// Route::post('/auth/check', function () { return Auth::check() * 1; })->name('auth.check.post');

// Public
Route::get('/', 'MainController@index')->name('main');
Route::get('/about', 'InfoController@about')->name('about');
Route::get('/team', 'InfoController@team')->name('team');
Route::get('/course/{course_id}', 'CourseController@view')->name('course.view');

// Payment
Route::get('/payment/{course_id}/{user_id?}/', 'PaymentController@pay')->name('payment.pay');
Route::post('/payment/{course_id}/{user_id?}/', 'PaymentController@pay')->name('payment.pay.post');
Route::get('/payment/result/success/{course_id?}/{user_id?}', 'PaymentController@success')->name('payment.success');
Route::post('/payment/result/success/', 'PaymentController@success')->name('payment.success.post');
Route::get('/payment/result/return/', 'PaymentController@return')->name('payment.return');
Route::post('/payment/result/return/', 'PaymentController@return')->name('payment.return.post');
Route::get('/payment/result/fail/', 'PaymentController@fail')->name('payment.fail');
Route::post('/payment/result/fail/', 'PaymentController@fail')->name('payment.fail.post');

// Subscribe
Route::post('/subscribe', 'SubscribeController@add')->name('subscribe.add.post');
Route::get('/unsubscribe/{email?}', 'SubscribeController@delete')->name('subscribe.delete');
Route::post('/unsubscribe/{email?}', 'SubscribeController@delete')->name('subscribe.add.post');

// Private
Route::group(['middleware' => 'auth.basic'], function () {
    Route::get('/home', 'MainController@home')->name('home');
    
    Route::get('/account/profile/{user_id?}', 'AccountController@profile')->name('account.profile');
    Route::post('/account/profile/{user_id?}', 'AccountController@profile')->name('account.profile.post');
    
    Route::get('/account/course/{course_id}/sertificate/{user_id?}/', 'CourseController@get_sertificate')->middleware('verified')->name('courses.sertificate');
});

Route::group(['middleware' => 'auth.client'], function () {
    Route::get('/account/courses/', 'CourseController@list_account')->middleware('verified')->name('account.courses');
    Route::get('/account/course/{course_id}/lecture/{lecture_id?}/', 'CourseController@lecture')->middleware('verified')->name('courses.lecture');
    Route::post('/account/course/{course_id}/lecture/{lecture_id?}/', 'CourseController@lecture')->middleware('verified')->name('courses.lecture.post');
});

Route::group(['middleware' => 'auth.admin'], function () {
    // Route::get('/account/courses/{user_id?}', 'CourseController@list_account')->middleware('verified')->name('account.courses');
    // Route::get('/account/course/{course_id}/lecture/{lecture_id?}/{user_id?}', 'CourseController@lecture')->middleware('verified')->name('courses.lecture');
    // Route::post('/account/course/{course_id}/lecture/{lecture_id?}/{user_id?}', 'CourseController@lecture')->middleware('verified')->name('courses.lecture.post');
    
    Route::get('/admin', 'AdminController@dashboard')->middleware('verified')->name('admin.dashboard');

    Route::post('/admin/setting', 'AdminController@setting')->middleware('verified')->name('admin.setting');

    Route::get('/admin/team', 'AdminController@team')->middleware('verified')->name('admin.team');
    Route::post('/admin/team', 'AdminController@team')->middleware('verified')->name('admin.team.post');

    Route::get('/admin/clients', 'AdminController@clients')->middleware('verified')->name('admin.clients');
    Route::post('/admin/clients', 'AdminController@clients')->middleware('verified')->name('admin.clients.post');
    Route::get('/admin/clients/download', 'AdminController@clients_download')->middleware('verified')->name('admin.clients.download');

    Route::get('/admin/reviews', 'AdminController@reviews')->middleware('verified')->name('admin.reviews');
    Route::post('/admin/reviews', 'AdminController@reviews')->middleware('verified')->name('admin.reviews.post');

    Route::get('/admin/contacts', 'AdminController@contacts')->middleware('verified')->name('admin.contacts');
    Route::post('/admin/contacts', 'AdminController@contacts')->middleware('verified')->name('admin.contacts.post');

    Route::get('/admin/courses_offline', 'CourseOfflineController@list_admin')->middleware('verified')->name('admin.courses_offline');
    Route::post('/admin/courses_offline', 'CourseOfflineController@list_admin')->middleware('verified')->name('admin.courses_offline.post');

    Route::get('/admin/courses/{sort_type?}', 'CourseController@list_admin')->middleware('verified')->name('admin.courses');
    Route::get('/admin/course/{course_id?}', 'CourseController@edit')->middleware('verified')->name('admin.course.edit');
    Route::post('/admin/course/{course_id?}', 'CourseController@edit')->middleware('verified')->name('admin.course.edit.post');
});

// For Testing
Route::get('/test', 'TestController@get')->name('test.get');
Route::post('/test', 'TestController@post')->name('test.post');
