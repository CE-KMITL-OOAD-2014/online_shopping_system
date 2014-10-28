<?php
class UserSaveIntegrTest extends TestCase {

  protected $userRepo;
  protected $user;

  public function setUp()
  {
    parent::setUp();
    
    Artisan::call('migrate');
    //not sure are we really need this code.
    //$this->seed();
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
    
    $userRepo = new core\EloUserRepo(new User());
    $this->assertEquals('john', $userRepo->find(1)->getUsername());
    $this->assertTrue(Auth::attempt(array('username' => 'john', 'password' => 'secret')));
    $this->assertRedirectedTo('/');
  }
}
