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
    $customer = new \core\Customer();
    $customer->setUsername(Input::get('username'));
    $customer->setPassword(Input::get('password'));
    $customer->setPermission('customer');
    $customer->setAddress(Input::get('address'));
    $customer->setemail(Input::get('email'));
    $customer->setPhone(Input::get('phone'));

    $this->customer->save($customer);

    return "eiei";
  }
}
