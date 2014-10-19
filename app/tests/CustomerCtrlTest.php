<?php

class CustomerCtrlTest extends TestCase {

  public function setUp() 
  {
    parent::setUp();
    Artisan::call('migrate');
    $this->seed();
  }

  public function testCustomerCreate()
  {
    $mock = Mockery::mock('core\ICustomerRepo');
    $mock->shouldReceive('save')->once();

    $this->app->instance('core\ICustomerRepo', $mock);

    $this->call('POST', 'user');
  }
}
