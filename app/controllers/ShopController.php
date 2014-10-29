<?php

class ShopController extends BaseController {

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

  public function index()
  {
          return View::make('shopHome', array('user' => core\User::newFromEloquent(Auth::user())));
  }

  public function cart()
  {
    //list of product_id
    $data['product_id'] = array(1,2,3);
    return View::make('cart/cart');
  }

  public function buy()
  {
    $user = core\User::newFromEloquent(Auth::user());
    $buying = new \core\DefaultBuyingAdapter(new \core\IOrderRepo(), new\core\ProductRepoInterface());
    $products = Cookie::get('cart_product');
    $user->buy($products, $buying);
  }
}
