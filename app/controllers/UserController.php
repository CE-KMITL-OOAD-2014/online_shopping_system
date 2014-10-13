<?php

class UserController extends BaseController
{

  protected $customer;

  public function __construct(ICustomerRepo $customer)
  {
    $this->customer = $customer;
  }

  //return form for create new user
  public function new()
  {

  }

  //create new user
  public function create()
  {

  }
}
