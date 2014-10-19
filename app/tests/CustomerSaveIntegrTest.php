<?php
class CustomerSaveIntegrTest extends TestCase {

  protected $customerRepo;
  protected $customer;

  public function setUp()
  {
    parent::setUp();
    
    Artisan::call('migrate');
    $this->seed();
  }

  public function testSaveUser()
  {
    $response = $this->call('POST','user', [
      'username' => 'john',
      'password' => 'secret',
      'password_confirmation' => 'secret',
      'address'  => 'Thailand',
      'email'    => 'test@testmail.com',
      'phone'    => '0812345678',
    ]);
    
    $customerRepo = new core\EloCustomerRepo(new Customer());
    $this->assertEquals('john', $customerRepo->find(1)->getUsername());
    $this->assertTrue(Auth::attempt(array('username' => 'john', 'password' => 'secret')));
    $this->assertRedirectedTo('/');
  }
}
