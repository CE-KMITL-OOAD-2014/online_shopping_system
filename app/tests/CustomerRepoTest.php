<?php
class CustomerRepoTest extends TestCase {

  protected $customerRepo;
  protected $customer;
  protected $mockEloCustomer;

  public function setUp()
  {
    parent::setUp();
    
    Artisan::call('migrate');
    $this->seed();
  }

  public function tearDown(){
    Mockery::close();
  }

  public function testSaveUser()
  {
    $this->customer = Mockery::mock('\core\Customer');
    $this->customer->shouldReceive('getUsername')->once()->andReturn('john');
    $this->customer->shouldReceive('getPassword')->once()->andReturn('password');
    $this->customer->shouldReceive('getPermission')->once()->andReturn('permission');
    $this->customer->shouldReceive('getAddress')->once()->andReturn('address');
    $this->customer->shouldReceive('getPhone')->once()->andReturn('phone');
    $this->customer->shouldReceive('getEmail')->once()->andReturn('email');

    $this->mockEloCustomer = Mockery::mock('Customer');

    $this->customerRepo = new EloCustomerRepo($this->mockEloCustomer);
    $this->app->instance('Customer', $this->mockEloCustomer);
    $this->mockEloCustomer->shouldReceive('save')->once();

    $this->customerRepo->save($this->customer);
  }
}
