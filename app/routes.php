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
	return View::make('home', array('user' => core\Customer::newFromEloquent(Auth::user())) );
});

Route::get('/test', function(){
	$data = "Drnutsu";
	return View::make('showData')->with('data',$data);
});

Route::get('/signup', 'CustomerController@form');

Route::post('user', 'CustomerController@create');

Route::get('/login', 'CustomerController@loginForm');

Route::post('/login',function()
{
  $credentials = Input::only('username', 'password');
  if(Auth::attempt($credentials)){
    return Redirect::intended('/');
  }
  return Redirect::to('login');
});

Route::get('/logout', function(){
  Auth::logout();
  return Redirect::to('/');
});

Route::get('/profile', array(
  'before' => 'auth',
  function()
  {
    return View::make('user/profile', array('user' => core\Customer::newFromEloquent(Auth::user())));
  }
));

Route::post('/profile', 'CustomerController@editProfile');
Route::get('/product', 'productController@index');

Route::get('/product/create','productController@create');
Route::post('/product', 'productController@store');

Route::get('/product/{id}/edit' , 'productController@edit');
Route::post('/product/{id}/edit', 'productController@update');
Route::get('/product/{id}/delete', 'productController@destroy');

Route::get('/home',	'HomeController@index');

Route::get('/shop/product','ShopControlller@product');
