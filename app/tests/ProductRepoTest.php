<?php 
	
	use \core\Product as Product;
	use \core\EloProductRepo as EloProductRepo;

	Class ProductRepoTest extends TestCase {
		protected $product_repo;
		protected $product;
		protected $mock_product_elo;

		public function setUp() {
			parent::setUp(); 

			Artisan::call('migrate'); // Call migration and seed database 
			$this->seed();
		}

		public function teardown() {
			Mockery::close(); // clear all Mock.
		}

		public function testCreateProduct() {

			$this->product = Mockery::mock('\core\Product'); //Create mocking Product Object
			//all getter method test
			$this->product->shouldReceive('getPrice')->once();
			$this->product->shouldReceive('getCategory')->once();
			$this->product->shouldReceive('getDescription')->once();
			$this->product->shouldReceive('getSize')->once();
			$this->product->shouldReceive('getColor')->once();
			$this->product->shouldReceive('getSuplier')->once();
			$this->product->shouldReceive('getAmount')->once();
			$this->product->shouldReceive('getProductName')->once();
			$this->product->shouldReceive('getImgPath')->once();
			
			//Mocking Model Product only call save method.  	
			$this->mock_product_elo = Mockery::mock('\Product[save]');

			//create product_repo and pass adapter that really call save method.
			$this->product_repo = new EloProductRepo($this->mock_product_elo);
			// Tell Laravel to use mock_product_elo instead of \Product
			$this->app->instance('\Product',$this->mock_product_elo);
			$this->mock_product_elo->shouldReceive('save')->once();

			//pass mocking product object  
			$this->product_repo->save($this->product);
		}

	}