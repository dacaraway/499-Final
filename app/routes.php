<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::get('/search', 'DVDController@getBoxes');
Route::get('/results', 'DVDController@listMovies');
Route::get('/dvds/create', 'DVDController@getBoxes2');
Route::post('/dvds', 'DVDController@add');
Route::get('/flickrSearch', 'FlickrController@search');
Route::get('/flickrResults', 'FlickrController@getResults');

