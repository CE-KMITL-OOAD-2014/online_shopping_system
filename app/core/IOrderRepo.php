<?php
namespace core;
interface IOrderRepo
{
  public function save(Order $order);
  public function find($id);
}
