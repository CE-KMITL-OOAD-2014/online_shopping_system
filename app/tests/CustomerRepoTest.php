<?php
class CustomerRepoTest extends TestCase {

  protected $customerRepo;
  protected $user;
  protected $mockEloUser;

  public function setUp()
  {
    parent::setUp();
    
    $this->customerRepo = new EloCustomerRepo();
    $this->user = Mockery::mock('\core\User');
    Artisan::call('migrate');
    $this->seed();
  }

  public function tearDown(){
    Mockery::close();
  }

  public function testSaveUser()
  {
    $this->mockEloUser = Mockery::mock('Eloquent', 'User');
    $this->mockEloUser->shouldReceive('save')->once();
    $this->app->instance('User', $this->mockEloUser);

    $this->customerRepo->save($this->user);
  }
}
