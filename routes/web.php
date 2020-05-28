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
Route::get('api/user/roles','HomeController@userRoles');

//Admin Routes
Route::get('api/users/{type}','AdminController@getUsers');


Auth::routes();



//Event
Route::post('api/events/create','EventController@store');
Route::post('api/events/edit','EventController@edit');
Route::get('api/events/delete/{id}','EventController@delete');
Route::get('api/events/userEvents','EventController@userEvents');

Route::post('api/events/bookEvent','EventBookingController@bookEvent');

//Venues



//Artists

//Route::get('/{any?}', 'HomeController@index');

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/events', 'EventController@index')->name('events');

Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '^(?!storage).*$');
