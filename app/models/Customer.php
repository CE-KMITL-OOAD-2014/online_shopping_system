<?php
class Customer extends Eloquent {
  public function setPasswordAttribute($password)
  {
    $this->attributes['password'] = Hash::make($password);
  }
}
