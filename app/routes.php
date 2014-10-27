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

Route::get('/test', function(){
	$data = "Drnutsu";
	return View::make('showData')->with('data',$data);
});

Route::get('/product', 'productController@index');

Route::get('/product/create','productController@create');
Route::post('/product', 'productController@store');

Route::get('/product/{id}/edit' , 'productController@edit');
Route::post('/product/{id}/edit', 'productController@update');
Route::get('/product/{id}/delete', 'productController@destroy');