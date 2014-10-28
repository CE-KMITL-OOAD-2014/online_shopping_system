<?php

class UserModelTest extends TestCase {

  public function setUp()                                            
  {
    parent::setUp();
    Artisan::call('migrate');
    $this->seed();
  }
  
  public function testHashPassword()
  {
    Hash::shouldReceive('make')->once()->andReturn('hashed');

    $customer = new User;
    $customer->password = 'passpwd';

    $this->assertEquals('hashed', $customer->password);
  }
}
