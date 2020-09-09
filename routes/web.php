<?php

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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');


Route::resource('cars','CarController')->name('*','admin')->middleware('admin');


Route::get('/bookings', 'BookingController@index')->name('*','member')->middleware('member');
Route::get('/bookings/create', 'BookingController@create')->name('*','member')->middleware('member');
Route::post('/bookings', 'BookingController@store')->name('*','member')->middleware('member');
Route::get('/bookings/{id}', 'BookingController@show')->name('*','member')->middleware('member');
Route::get('/bookings/{id}/edit', 'BookingController@edit')->name('*','member')->middleware('member');
Route::patch('/bookings/{id}', 'BookingController@update')->name('*','member')->middleware('member');
Route::delete('/bookings/{id}', 'BookingController@destroy')->name('*','member')->middleware('member');
Route::get('/bookings/{id}/past', 'BookingController@past')->name('*','member')->middleware('member');

Route::get('/users/{id}', 'UserController@show')->name('*','member')->middleware('member');
Route::delete('/users/{id}', 'UserController@destroy')->name('*','member')->middleware('member');
Route::get('/users/{id}/edit', 'UserController@edit')->name('*','member')->middleware('member');
Route::patch('/users/{id}', 'UserController@update')->name('*','member')->middleware('member');

Route::get('/users/finishPayment/{id}', 'BookingController@finishPayment')->name('*','member')->middleware('member');

Route::get('/admins/allusers','AdminController@allusers')->name('*','admin')->middleware('admin');
