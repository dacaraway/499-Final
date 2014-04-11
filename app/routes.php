<?php

use \Symfony\Component\HttpFoundation\Session\Session;

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/flickrSearch', 'FlickrController@search');
Route::get('/flickrResults', 'FlickrController@getResults');
Route::get('/login', function(){
    return View::make('login');
});

Route::post('/login-process', 'LoginController@validate');
Route::get('/dashboard', function(){
    return View::make('dashboard');
});

Route::get('/signUp', function(){
    return View::make('signUp');
});

Route::post('/signUp-process', 'LoginController@signUp');

Route::get('/logout', 'LoginController@logout');
Route::post('/pin', 'DBController@insert');
Route::get('/mypins/get/{category}', function($category){

    $session = new Session();
    $id = $session->get('id');
    $cat = Database::getCat($category);
    $results = Database:: find($category, $id);

    return View::make('mypins', [
        'results' => $results,
        'category' => $cat
    ]);
});


Route::post('/upload', 'FlickrController@upload');
Route::post('/delete', 'DBController@deletePin');



