<?php
namespace core;
Class EloProductRepo implements \core\ProductRepoInterface
{
  protected $eloProduct;

  public function __construct(\Product $eloProduct)
  {
    $this->eloProduct = $eloProduct;
  }

  public function save(\core\Product $product)
  {
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

  public function saveId(\core\Product $product,$id)
  {
    $this->eloProduct =	$this->eloProduct->find($id);

    $this->eloProduct->product_name = $product->getProductName();
    $this->eloProduct->price = $product->getPrice();
    $this->eloProduct->category = $product->getCategory();
    $this->eloProduct->description = $product->getDescription();
    $this->eloProduct->size = $product->getSize();
    $this->eloProduct->color = $product->getColor();
    $this->eloProduct->suplier = $product->getSuplier();
    $this->eloProduct->amount = $product->getAmount();
    $this->eloProduct->pro_type = $product->getAdapterType();

    if($product->getAdapterType() == "PromotionDiscountAdapter"){
      $this->eloProduct->pro_percent = $product->getProPercent();
    }else if($product->getAdapterType() == "PromotionBuyXFreeYAdapter"){
      $this->eloProduct->promotionXY = $product->getXYparams(); 
    }						
      $this->eloProduct->save();
   }

  public function find($id)
  {
    $product = $this->eloProduct->find($id);
			
    $productObj = new \core\Product();
    $productObj->setId($product->id);
    $productObj->setProductName($product->product_name);
    $productObj->setPrice($product->price);
    $productObj->setCategory($product->category);
    $productObj->setDescription($product->description);
    $productObj->setSize($product->size);
    $productObj->setColor($product->color);
    $productObj->setSuplier($product->suplier);
    $productObj->setImgPath($product->imgPath);
    $productObj->setAmount($product->amount);
    $productObj->setAdapterType($product->pro_type);
    
    // Logic for Load Promotion Info
    if($product->pro_type != ""){
      $adapter = "\\core\\".$product->pro_type;
      $productObj->setPromotionAdapter(new $adapter());
      if($product->pro_type == "PromotionDiscountAdapter"){
        $productObj->setPromotion($product->pro_percent,$product->price);
      } else if($product->pro_type == "PromotionBuyXFreeYAdapter"){
         $productObj->setPromotion($product->promotionXY,$product->price);
         $productObj->setXYparams($product->promotionXY);
      }
    }
    return $productObj;
  }

  public function where($column,$operator,$value)
  {
    $value = $this->eloProduct->where($column,$operator,$value)->get();
    $products = array();

    foreach ($value as $product) {
      $productObj = new \core\Product();
      $productObj->setId($product->id);
      $productObj->setProductName($product->product_name);
      $productObj->setPrice($product->price);
      $productObj->setCategory($product->category);
      $productObj->setDescription($product->description);
      $productObj->setSize($product->size);
      $productObj->setColor($product->color);
      $productObj->setSuplier($product->suplier);
      $productObj->setImgPath($product->imgPath);
      $productObj->setAmount($product->amount);
      $productObj->setAdapterType($product->pro_type);
      
      // Logic for Load Promotion Info
      if($product->pro_type != ""){
        $adapter = "\\core\\".$product->pro_type;
        $productObj->setPromotionAdapter(new $adapter());

        if($product->pro_type == "PromotionDiscountAdapter"){
          $productObj->setPromotion($product->pro_percent,$product->price);
        } else if ($product->pro_type == "PromotionBuyXFreeYAdapter"){
          $productObj->setPromotion($product->promotionXY,$product->price);
          $productObj->setXYparams($product->promotionXY);
        }
      }
      $products[] = $productObj;
    }
    return $products;
  }

  public function all()
  {
    $value = $this->eloProduct->all();
    $products = array();
    foreach ($value as $product) {
      $productObj = new \core\Product();
      $productObj->setId($product->id);
      $productObj->setProductName($product->product_name);
      $productObj->setPrice($product->price);
      $productObj->setCategory($product->category);
      $productObj->setDescription($product->description);
      $productObj->setSize($product->size);
      $productObj->setColor($product->color);
      $productObj->setSuplier($product->suplier);
      $productObj->setImgPath($product->imgPath);
      $productObj->setAmount($product->amount);
      $productObj->setAdapterType($product->pro_type);
      
      // Logic for Load Promotion Info
      if($product->pro_type != ""){
        $adapter = "\\core\\".$product->pro_type;
        $productObj->setPromotionAdapter(new $adapter());
        if($product->pro_type == "PromotionDiscountAdapter"){
          $productObj->setPromotion($product->pro_percent,$product->price);
        } else if ($product->pro_type == "PromotionBuyXFreeYAdapter"){
          $productObj->setPromotion($product->promotionXY,$product->price);
          $productObj->setXYparams($product->promotionXY);
        }
      }
      $products[] = $productObj;
    }
    return $products;
  }

  public function remove($id)
  {
    $product = $this->eloProduct->find($id);
    $product->delete();
  }
}
