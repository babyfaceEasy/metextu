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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');
Route::get('/client/profile', 'HomeController@showProfile')->name('show.profile');
Route::get('/client/edit_profile', 'HomeController@showEditProfile')->name('show.edit.profile');
Route::post('/client/profile', 'HomeController@updateProfile')->name('update.profile');

Route::view('/client/change_password', 'auth.passwords.change')->name('show.change.password');
Route::post('/client/change_password', 'HomeController@changePassword')->name('change.password');
