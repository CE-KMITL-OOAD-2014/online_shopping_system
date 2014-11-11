<?php

class Order extends Eloquent
{
  public function products()
  {
    return $this->belongsToMany('Product');
  }
}
