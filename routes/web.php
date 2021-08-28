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
Route::post('api/venues/create','VenueController@store');
Route::post('api/venues/edit','VenueController@edit');
Route::get('api/venues/delete/{id}','VenueController@delete');
Route::get('/api/venues/toggleActive/{id}','VenueController@toggleActive');
Route::get('api/venues/userVenues','VenueController@userVenues');
Route::get('api/venues/bookings/{id}','VenueBookingController@venueBookings');
Route::post('api/venues/bookingActions','VenueBookingController@bookingActions');


Route::post('api/venues/bookVenue','VenueBookingController@bookVenue');
Route::get('api/venues/booking-information/{code}/{id}','VenueBookingController@bookingInformation');


//Artists
Route::get('api/artists/profile','ArtistController@artistProfile');
Route::post('api/artists/genres','ArtistGenreController@store');
Route::post('api/artists/edit','ArtistController@edit');
Route::post('api/artists/saveImage','ArtistController@editImage');
Route::post('api/artists/bookingActions','ArtistBookingController@bookingActions');


Route::post('api/artists/bookArtist','ArtistBookingController@bookArtist');
Route::get('api/artists/booking-information/{code}/{id}','ArtistBookingController@bookingInformation');





//Video Routes
Route::post('/video/save', 'VideoController@store');

Route::get('/video/delete/{id}','VideoController@delete');


//Payment Routes

Route::get('payment/test','PaymentController@generateToken2');


//Route::get('/{any?}', 'HomeController@index');

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/events', 'EventController@index')->name('events');

Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '^(?!storage).*$');
