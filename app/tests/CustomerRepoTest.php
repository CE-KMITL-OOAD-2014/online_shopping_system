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
    $this->customer->shouldReceive('getUsername')->once();
    $this->customer->shouldReceive('getPassword')->once();
    $this->customer->shouldReceive('getPermission')->once();
    $this->customer->shouldReceive('getAddress')->once();
    $this->customer->shouldReceive('getPhone')->once();
    $this->customer->shouldReceive('getEmail')->once();

    $this->mockEloCustomer = Mockery::mock('\Customer[save]');

    $this->customerRepo = new \core\EloCustomerRepo($this->mockEloCustomer);
    $this->app->instance('Customer', $this->mockEloCustomer);
    $this->mockEloCustomer->shouldReceive('save')->once();

    $this->customerRepo->save($this->customer);
  }
}
