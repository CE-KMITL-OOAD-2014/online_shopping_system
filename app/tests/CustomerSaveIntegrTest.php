<?php
class CustomerSaveIntegrTest extends TestCase {

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
    $response = $this->call('POST','user', [
      'username' => 'john',
      'password' => 'secret',
      'address'  => 'Thailand',
      'email'    => 'test@testmail.com',
      'phone'    => '0812345678',
    ]);

    $customerRepo = new core\EloCustomerRepo(new Customer());
    $this->assertEquals('john', $customerRepo->find(1)->username);
    $this->assertTrue(Hash::check('secret', $customerRepo->find(1)->password));
    $this->assertTrue(Auth::attempt(array('username' => 'john', 'password' => 'secret')));
  }
}
