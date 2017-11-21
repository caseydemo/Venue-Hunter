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

Route::get('/', 'GuzzleController@getInput');

Route::post('/geocode', 'GuzzleController@getGeocode');

Route::post('/nearby', 'GuzzleController@getNearbySearch');

Route::get('/detail/{place_id}', 'GuzzleController@getDetailSearch');

