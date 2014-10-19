<?php
namespace core;
class EloCustomerRepo implements \core\ICustomerRepo {

  protected $eloCustomer;

  public function __construct(\Customer $eloCustomer)
  {
     $this->eloCustomer = $eloCustomer;
  }

  public function save(\core\Customer $customer)
  {
    $this->eloCustomer->username = $customer->getUsername();
    $this->eloCustomer->password = $customer->getPassword();
    $this->eloCustomer->permission = $customer->getPermission();
    $this->eloCustomer->address =  $customer->getAddress();
    $this->eloCustomer->phone = $customer->getPhone();
    $this->eloCustomer->email = $customer->getEmail();

    $this->eloCustomer->save();
  }

  public function find($id)
  {
    $eloquent = \Customer::find($id);
    $customer = new Customer();
    $customer->setUsername($eloquent->username);
    $customer->setPassword($eloquent->password);
    $customer->setPermission($eloquent->permission);
    $customer->setAddress($eloquent->address);
    $customer->setPhone($eloquent->phone);
    $customer->setEmail($eloquent->email);
    return $customer;
  }
}
