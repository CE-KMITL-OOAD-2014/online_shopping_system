<?php

class Product extends \Eloquent {
  protected $fillable = [];

  public function orders()
  {
    return $this->belongsToMany('Order');
  }
}
