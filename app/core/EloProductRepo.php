<?php
	namespace core;
	Class EloProductRepo implements \core\ProductRepoInterface {
		protected $eloProduct;

		public function __construct(\Product $eloProduct){
			$this->eloProduct = $eloProduct;
		}

		public function save(\core\Product $product){
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
			return \Product::find($id);
		}
	}