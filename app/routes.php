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
	return View::make('home');
});

Route::get('/test', function(){
	$data = "Drnutsu";
	return View::make('showData')->with('data',$data);
});

Route::get('/signup', 'CustomerController@form');

Route::get('/login', 'CustomerController@loginForm');

Route::post('/login',function()
{
  $credentials = Input::only('username', 'password');
  /*if (Auth::attempt($credentials)){
    return 'login successful';
  }
  return Redirect::to('login');*/
  if(Hash::check($credentials['password'], Customer::find(3)->password))
  {
    return 'match';
  } else {
    return 'not match';
  }
});

Route::post('user', 'CustomerController@create');
