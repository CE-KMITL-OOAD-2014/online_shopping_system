<?php
namespace core;
interface ICustomerRepo {
  public function save(\core\Customer $customer);
}
