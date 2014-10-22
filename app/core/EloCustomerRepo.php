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
    $existCustomer = \Customer::find($customer->getId());
    //$existCustomer = \Customer::find($customer->getId());
    if($existCustomer != null){
      if($customer->getPassword() != ""){
        $existCustomer->password = $customer->getPassword();
      }

      $existCustomer->address = $customer->getAddress();
      $existCustomer->phone = $customer->getPhone();
      $existCustomer->email = $customer->getEmail();

      $existCustomer->save();
    } else  {
      $this->eloCustomer->username = $customer->getUsername();
      $this->eloCustomer->password = $customer->getPassword();
      $this->eloCustomer->permission = $customer->getPermission();
      $this->eloCustomer->address =  $customer->getAddress();
      $this->eloCustomer->phone = $customer->getPhone();
      $this->eloCustomer->email = $customer->getEmail();

      $this->eloCustomer->save();
    }

    //return var_dump($existCustomer).var_dump($customer);
  }

  public function find($id)
  {
    $eloquent = \Customer::find($id);
    $customer = new Customer();
    $customer->setId($eloquent->id);
    $customer->setUsername($eloquent->username);
    $customer->setPassword($eloquent->password);
    $customer->setPermission($eloquent->permission);
    $customer->setAddress($eloquent->address);
    $customer->setPhone($eloquent->phone);
    $customer->setEmail($eloquent->email);
    return $customer;
  }
}
