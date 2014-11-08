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

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/',	'ShopController@index');
Route::get('/signup', 'UserController@form');
Route::post('user', 'UserController@create');
Route::get('/login', 'UserController@loginForm');

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
    return View::make('user/profile', array('user' => core\User::newFromEloquent(Auth::user())));
  }
));

Route::post('/profile', 'UserController@editProfile');


/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/
Route::get('/product', 'productController@index');
Route::post('/product', 'productController@store');
Route::get('/product/create','productController@create');
Route::get('/product/{id}/edit' , 'productController@edit');
Route::post('/product/{id}/edit', 'productController@update');
Route::get('/product/{id}/delete', 'productController@destroy');


/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
*/
Route::get('/shop/{id}/view','ShopController@show');
Route::get('shop/order/','ShopController@orderShow');
Route::get('shop/contactUs','ShopController@contactUs');

Route::get('shop/chat','chatController@index');

Route::post('shop/chat','chatController@store');

Route::get('/shop/product','ShopController@product');
Route::get('/shop/{id}/view','ShopController@show');

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/

Route::get('cart', 'ShopController@cart');
Route::get('buy', 'ShopController@buy');