<?php 
	namespace core;
	use \core\Product as Product;
	interface ProductRepoInterface {
		public function save(Product $product);
	}