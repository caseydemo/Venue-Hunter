<?php
require __DIR__ . '/../vendor/autoload.php';

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

Route::get('/map', function () {
    return view('places.map');
});

Auth::routes();

// test ajax call
Route::post('/places/test', 'AjaxController@updateCustomerRecord');



// Route::get('/', 'GuzzleController@getInput');

Route::resource('/test', 'GeolocationController');

Route::post('/recent-search', 'SearchController@getRecentSearch');

Route::post('/geolocate', 'SearchController@geolocateSearch'); // if user location is known

Route::get('/show-contacts/{place_id}', 'ContactController@getDetailSearch');

Route::post('/', 'SearchController@getGeocode');

Route::resource('/places', 'SearchController');

Route::get('/detail/{place_id}', 'SearchController@getDetailSearch');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/saved', 'SearchController@showSavedSearches');

Route::resource('/contacts', 'ContactController');

Route::get('/userTimeline', function()
{
	return Twitter::getUserTimeline(['screen_name' => 'realDonalTrump', 'count' => 20, 'format' => 'json']);
});

Route::get('/getGeo', 'TwitterController@getGeo');

Route::get('/getUser', 'TwitterController@getTwitterHandle');

Route::get('/getUserLookup', 'TwitterController@getUserLookup');

Route::get('/getUserTimeline', 'TwitterController@getUserTimeline');

Route::get('/getUsersSearch', 'TwitterController@getUsersSearch');


