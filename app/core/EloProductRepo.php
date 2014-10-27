<?php
	namespace core;
	Class EloProductRepo implements \core\ProductRepoInterface {
		protected $eloProduct;

		public function __construct(\Product $eloProduct){
			$this->eloProduct = $eloProduct;
		}

		public function save(\core\Product $product){
			$this->eloProduct->product_name = $product->getProductName();
			$this->eloProduct->price = $product->getPrice();
			$this->eloProduct->category = $product->getCategory();
			$this->eloProduct->description = $product->getDescription();
			$this->eloProduct->size = $product->getSize();
			$this->eloProduct->color = $product->getColor();
			$this->eloProduct->suplier = $product->getSuplier();
			$this->eloProduct->amount = $product->getAmount();
			$this->eloProduct->imgPath = $product->getImgPath();			
			$this->eloProduct->save();
		}

		public function saveId(\core\Product $product,$id){
			$this->eloProduct =	$this->eloProduct->find($id);

			$this->eloProduct->product_name = $product->getProductName();
			$this->eloProduct->price = $product->getPrice();
			$this->eloProduct->category = $product->getCategory();
			$this->eloProduct->description = $product->getDescription();
			$this->eloProduct->size = $product->getSize();
			$this->eloProduct->color = $product->getColor();
			$this->eloProduct->suplier = $product->getSuplier();
			$this->eloProduct->amount = $product->getAmount();
					
			$this->eloProduct->save();
		}

		public function find($id){
			
			$product = $this->eloProduct->find($id);
			
			$productObj = new \core\Product();
			$productObj->setProductName($product->product_name);
			$productObj->setPrice($product->price);
			$productObj->setCategory($product->category);
			$productObj->setDescription($product->category);
			$productObj->setSize($product->size);
			$productObj->setColor($product->color);
			$productObj->setSize($product->size);
			$productObj->setSuplier($product->suplier);
			$productObj->setAmount($product->amount);
			$productObj->setImgPath($product->imgPath);
			
			return $productObj;
		}

		public function all(){
			return \Product::all();
		}

		public function remove($id){
			$product = $this->eloProduct->find($id);
			$product->delete();
		}
	}