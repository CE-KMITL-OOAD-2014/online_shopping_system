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
    return Redirect::intended();
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


Route::post('/admin/{username}/online','UserController@userOnline');
Route::post('/admin/check','UserController@checkAdmin');

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
Route::get('/product/{id}/promotion','productController@createPromotion');
Route::post('/product/{id}/promotion','productController@storePromotion');


/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
*/
Route::get('/shop/{id}/view','ShopController@show');
Route::get('shop/order/','ShopController@shopOrder');
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
Route::post('buy', 'ShopController@buy');

/*
|--------------------------------------------------------------------------
| Report Routes
|--------------------------------------------------------------------------
*/

Route::get('report', 'ReportController@index');
Route::post('productSold', 'ReportController@soldProduct');
Route::post('income', 'ReportController@income');
Route::post('profit', 'ReportController@profit');

/*
|--------------------------------------------------------------------------
| REST API Routes
|--------------------------------------------------------------------------
*/

Route::group( array('prefix' => 'api'), function() {
  Route::get('product/{id}', 'productController@restGet');
});

