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


//Route::get('/{any?}', 'HomeController@index');

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/events', 'EventController@index')->name('events');

Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '^(?!storage).*$');
