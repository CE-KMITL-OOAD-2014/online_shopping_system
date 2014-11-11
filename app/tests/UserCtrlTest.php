<?php

class UserCtrlTest extends TestCase {

  public function setUp() 
  {
    parent::setUp();
    Artisan::call('migrate');
    $this->seed();
  }

  public function testUserCreate()
  {
    $mock = Mockery::mock('core\IUserRepo');
    $mock->shouldReceive('save')->once();

    $this->app->instance('core\IUserRepo', $mock);

    $this->call('POST', 'user');
  }
}
