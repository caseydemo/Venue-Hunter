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



// Route::resource('/places', 'PlacesController');

Route::post('/', 'GuzzleController@getNearbySearch');

Route::get('/', 'GuzzleController@getInput');

Route::get('/detail/{place_id}', 'GuzzleController@getDetailSearch');

// Route::get('/lat', 'GuzzleController@getInput');