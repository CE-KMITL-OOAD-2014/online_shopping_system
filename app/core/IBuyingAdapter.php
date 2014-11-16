<?php
namespace core;
/**
 * Interface for buying adapter
 *
 */
interface IBuyingAdapter
{
  public function buy($products, $user);
}

