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

  }

  //create new user
  public function create()
  {
    $customer = new \core\Customer();
    $customer->setUsername('john');
    $customer->setPassword('secret');
    $customer->setPermission('customer');
    $customer->setAddress('Thailand');
    $customer->setemail('testmail@testmail.com');
    $customer->setPhone('0812345678');

    $this->customer->save($customer);
  }
}
