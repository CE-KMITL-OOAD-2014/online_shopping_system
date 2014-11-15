<?php

class UserController extends BaseController
{

  protected $user;

  public function __construct(core\IUserRepo $user)
  {
    $this->user = $user;
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
      'username' => 'required|alpha_num|unique:users',
      'password' => 'required|alpha_num|confirmed',
      'address' => 'required',
      'phone' => 'required|numeric',
      'email' => 'required|email',
    );
    $validator = Validator::make(Input::all(), $rules);

    if($validator->passes()){
      $user = new \core\User();
      $user->setUsername(Input::get('username'));
      $user->setPassword(Input::get('password'));
      $user->setPermission('user');
      $user->setAddress(Input::get('address'));
      $user->setemail(Input::get('email'));
      $user->setPhone(Input::get('phone'));

      $this->user->save($user);
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
      $user = $this->user->find(Auth::user()->id);
      $user->setAddress(Input::get('address'));
      $user->setPhone(Input::get('phone'));
      $user->setEmail(Input::get('email'));

      if(Input::get('password')!=""){
        $user->setPassword(Input::get('password'));
      }
      $this->user->save($user);
    }

    return Redirect::to('profile')->withErrors($validator);
  }

  public function loginForm()
  {
    return View::make('user/login');
  }

  public function checkAdmin()
  {
    $check = $this->user->checkAdmin();
    return $check;
  }

  public function userOnline($username)
  {
    if(Request::ajax()) {
      $status = Input::get('status');
      $result = $this->user->updateStatus($status,$username);
    }
  }
}
