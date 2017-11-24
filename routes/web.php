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

Auth::routes();

// Route::get('/', 'GuzzleController@getInput');

Route::post('/', 'SearchController@getGeocode');

Route::resource('/places', 'SearchController');

Route::get('/detail/{place_id}', 'SearchController@getDetailSearch');

Route::get('/home', 'HomeController@index')->name('home');
