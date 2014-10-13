<?php
class EloCustomerRepo implements ICustomerRepo {

  protected $eloCustomer;

  public function __construct(Customer $eloCustomer)
  {
     $this->eloCustomer = $eloCustomer;
  }

  public function save(\core\Customer $customer)
  {
    $this->eloCustomer->attributes['username'] = $customer->getUsername();
    $this->eloCustomer->attributes['password'] = $customer->getPassword();
    $this->eloCustomer->attributes['permission'] = $customer->getPermission();
    $this->eloCustomer->attributes['address'] = $customer->getAddress();
    $this->eloCustomer->attributes['phone'] = $customer->getPhone();
    $this->eloCustomer->attributes['email'] = $customer->getEmail();

    $this->eloCustomer->save();
  }
}
