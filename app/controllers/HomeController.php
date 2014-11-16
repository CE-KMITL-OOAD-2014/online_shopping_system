<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function __construct(){
		$this->productHelper = new \core\EloProductRepo(new \Product());
	}

	public function index()
	{
		$products = $this->productHelper->all();
		return View::make('shopHome', array('user' => core\User::newFromEloquent(Auth::user()),'products' => $products ));
	}

}
