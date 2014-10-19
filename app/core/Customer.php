<?php
namespace core;
class Customer {
  protected $username;
  protected $password;
  protected $permission;
  protected $address;
  protected $phone;
  protected $email;

  public function __construct(){
  }

  public static function newFromEloquent($eloquent){
    if($eloquent != null){
      $customer = new self();
      $customer->username = $eloquent->username;
      $customer->password = $eloquent->password;
      $customer->permission = $eloquent->permission;
      $customer->address = $eloquent->address;
      $customer->phone = $eloquent->phone;
      $customer->email = $eloquent->email;

      return $customer;
    }
    return null;
  }

  public function getUsername(){
    return $this->username;
  }


  public function getPassword(){
    return $this->password;
  }


  public function getPermission(){
    return $this->permission;
  }

  
  public function getAddress(){
    return $this->address;
  }

  public function getPhone(){
    return $this->phone;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setUsername($username){
    $this->username = $username;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function setPermission($permission){
    $this->permission = $permission;
  }

  public function setAddress($address){
    $this->address = $address;
  }

  public function setPhone($phone){
    $this->phone = $phone;
  }

  public function setEmail($email){
    $this->email = $email;
  }
}
