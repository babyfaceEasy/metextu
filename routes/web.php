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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');
Route::get('/client/profile', 'HomeController@showProfile')->name('show.profile');
Route::get('/client/edit_profile', 'HomeController@showEditProfile')->name('show.edit.profile');
Route::post('/client/profile', 'HomeController@updateProfile')->name('update.profile');

Route::view('/client/change_password', 'auth.passwords.change')->name('show.change.password');
Route::post('/client/change_password', 'HomeController@changePassword')->name('change.password');
Route::get('/datatable/groups/data', 'GroupController@getGroups')->name('dataTable.groups');
Route::resource('/client/groups', 'GroupController');
Route::get('/datatable/{group}/contacts/data', 'ContactController@getContacts')->name('dataTable.contacts');
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

//credits section
Route::get('/clients/credits/main', 'CreditController@getCreditPage')->name('credit.page');
Route::post('/clients/credits/purchase', 'CreditController@purchaseCredits')->name('purchase.credit');
Route::get('/clients/credits/transfer_pg', 'CreditController@getTransferPage')->name('transfer.page');
Route::post('/clients/credits/transfer', 'CreditController@transferCredits')->name('transfer.credit');