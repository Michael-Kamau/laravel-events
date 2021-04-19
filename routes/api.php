<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Events Routes

Route::get('events','EventController@index');

//Venues Routes

Route::get('venues','VenueController@index');


//Artists Routes
Route::get('artists','ArtistController@index');
Route::get('artists/genres','ArtistGenreController@index');



Route::get('/email/{eventId}', 'EventBookingController@mailEventBookingPdf');

Route::get('STKPay','MpesaPaymentController@STK_Push');
