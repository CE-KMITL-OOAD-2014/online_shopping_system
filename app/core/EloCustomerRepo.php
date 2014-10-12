<?php
class EloCustomerRepo implements ICustomerRepo {

  protected $eloCustomer;

  public function __construct()
  {
     $this->eloCustomer = new User();
  }

  public function save(\core\User $user)
  {
    $this->eloCustomer->id = $user->id;
    $this->eloCustomer->username = $user->username;
    $this->eloCustomer->password = $user->password;
    $this->eloCustomer->permission = $user->permission;
    $this->eloCustomer->address = $user->address;
    $this->eloCustomer->phone = $user->phone;
    $this->eloCustomer->email = $user->email;

    $this->eloCustomer->save();
  }
}
