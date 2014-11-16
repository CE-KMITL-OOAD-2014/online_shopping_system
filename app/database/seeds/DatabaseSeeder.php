<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            Eloquent::unguard();

            $this->call('UserTableSeeder');
            $this->call('ProductTableSeeder');
            $this->command->info('user table seeded');
	}
}

class UserTableSeeder extends Seeder
{
  public function run()
  {
    User::create(array(
      'username' => 'testuser',
      'password' => '1234',
      'permission' => 'customer',
      'address' => 'KMITL',
      'phone' => '0888888888',
      'email' => 'test.email@testmail.com',
    ));
  }
}

class ProductTableSeeder extends Seeder
{
  public function run()
  {
    Product::create(array(
      'product_name'=> 'product1',
      'price' => 350,
      'category' => 'cat1',
      'description' => 'this is test product',
      'size' => 'M',
      'color' => 'red',
      'suplier' => 'sup',
      'amount' => '5',
      'imgPath' => 'path/to/img',
    ));

    Product::create(array(
      'product_name'=> 'product2',
      'price' => 250,
      'category' => 'cat2',
      'description' => 'this is test product',
      'size' => 'L',
      'color' => 'yellow',
      'suplier' => 'sup2',
      'amount' => '3',
      'imgPath' => 'path/to/img2',
    ));

    Product::create(array(
      'product_name'=> 'product2',
      'price' => 100.50,
      'category' => 'cat3',
      'description' => 'this is test product',
      'size' => 'M',
      'color' => 'green',
      'suplier' => 'sup',
      'amount' => '6',
      'imgPath' => 'path/to/img3',
    ));
    
  }
}
