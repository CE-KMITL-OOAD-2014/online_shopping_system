<?php
class Customer {
  protected $username;
  protected $password;
  protected $permission;
  protected $address;
  protected $phone;
  protected $email;

  public function __construct(){
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
    $this->password = password;
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
