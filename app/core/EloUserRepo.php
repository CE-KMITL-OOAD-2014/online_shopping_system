<?php
namespace core;
class EloUserRepo implements \core\IUserRepo {

  protected $eloUser;

  public function __construct(\User $eloUser)
  {
     $this->eloUser = $eloUser;
  }

  public static function first(){
    $eloquent = \User::first();
    $user = new User();
    $user->setId($eloquent->id);
    $user->setUsername($eloquent->username);
    $user->setPassword($eloquent->password);
    $user->setPermission($eloquent->permission);
    $user->setAddress($eloquent->address);
    $user->setPhone($eloquent->phone);
    $user->setEmail($eloquent->email);
    return $user;
  }

  public function save(\core\User $user)
  {
    $existUser = \User::find($user->getId());
    if($existUser != null){
      if($user->getPassword() != ""){
        $existUser->password = $user->getPassword();
      }

      $existUser->address = $user->getAddress();
      $existUser->phone = $user->getPhone();
      $existUser->email = $user->getEmail();

      $existUser->save();
    } else  {
      $this->eloUser->username   = $user->getUsername();
      $this->eloUser->password   = $user->getPassword();
      $this->eloUser->permission = $user->getPermission();
      $this->eloUser->address    = $user->getAddress();
      $this->eloUser->phone      = $user->getPhone();
      $this->eloUser->email      = $user->getEmail();

      $this->eloUser->save();
    }
  }

  public function find($id)
  {
    $eloquent = \User::find($id);
    $user = new User();
    $user->setId($eloquent->id);
    $user->setUsername($eloquent->username);
    $user->setPassword($eloquent->password);
    $user->setPermission($eloquent->permission);
    $user->setAddress($eloquent->address);
    $user->setPhone($eloquent->phone);
    $user->setEmail($eloquent->email);
    return $user;
  }
}
