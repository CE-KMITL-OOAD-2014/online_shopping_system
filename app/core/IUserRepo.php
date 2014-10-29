<?php
namespace core;
interface IUserRepo {
  public static function first();
  public function save(\core\User $customer);
  public function find($id);
}
