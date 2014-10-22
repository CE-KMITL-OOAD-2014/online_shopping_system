<?php

class CustomerController extends BaseController
{

  protected $customer;

  public function __construct(core\ICustomerRepo $customer)
  {
    $this->customer = $customer;
  }

  //return form for create new user
  public function form()
  {
    return View::make('user/new');
  }

  //create new user
  public function create()
  {
     $rules = array( 
      'username' => 'required|alpha_num|unique:customers',
      'password' => 'required|alpha_num|confirmed',
      'address' => 'required',
      'phone' => 'required|numeric',
      'email' => 'required|email',
    );
    $validator = Validator::make(Input::all(), $rules);


    if($validator->passes()){
      $customer = new \core\Customer();
      $customer->setUsername(Input::get('username'));
      $customer->setPassword(Input::get('password'));
      $customer->setPermission('customer');
      $customer->setAddress(Input::get('address'));
      $customer->setemail(Input::get('email'));
      $customer->setPhone(Input::get('phone'));

      $this->customer->save($customer);
      return Redirect::to('/');
    }

    return Redirect::to('/signup')->withErrors($validator);
  }

  //edit user info
  public function editProfile()
  {
    $rules = array(
      'current-password' => 'required|alpha_num',
      'password' => 'alpha_num|confirmed',
      'address' => 'required',
      'phone' => 'required|numeric',
      'email' => 'required|email',
    );

    $validator = Validator::make(Input::all(), $rules);

    if($validator->passes()){
      $user = $this->customer->find(Auth::user()->id);
      $user->setAddress(Input::get('address'));
      $user->setPhone(Input::get('phone'));
      $user->setEmail(Input::get('email'));

      if(Input::get('password')!=""){
        $user->setPassword(Input::get('password'));
      }

      $this->customer->save($user);
    }

    return Redirect::to('profile')->withErrors($validator);
  }

  public function loginForm()
  {
    return View::make('user/login');
  }

}
