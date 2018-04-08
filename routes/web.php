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
Route::resource('/client/groups', 'GroupController');
Route::get('/all-contacts', 'ContactController@allContacts')->name('all.contacts');
Route::resource('/client/groups.contacts', 'ContactController');

//for sms section
Route::get('/test-sms', 'ContactController@testSMSSender')->name('test.sms');
Route::get('clients/create-sms', 'SMSController@create')->name('create.sms');
Route::post('/clients/send-sms', 'SMSController@sendSMS')->name('send.sms');
//handle the sms updates
Route::post('/sms-status-updates', 'SMSController@delivery_report')->name('sms.status');

//test activities
Route::get('/test/mail', 'TestController@sendMail')->name('test.mail');