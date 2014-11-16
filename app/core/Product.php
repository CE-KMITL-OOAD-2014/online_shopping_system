<?php 
namespace core;

class Product 
{
  protected $id;
  protected $product_name;
  protected $price;
  protected $category;
  protected $description;
  protected $size;
  protected $color;
  protected $suplier;
  protected $amount;
  protected $imgPath = "";
  protected $has_promotion = false; //Is this product has promotion.
  protected $promotion; // Promotion adapter for execute.
  protected $pro_percent = 0;
  protected $XY_params;
  protected $adapter_type;

  public function __construct() 
  {
  }

  //Create new /core/product object from Eloquent Product
  public static function newFromEloquent($eloquent){
    if($eloquent != null){
      $product = new self();
      $product->id = $eloquent->id;
      $product->product_name = $eloquent->product_name;
      $product->price = $eloquent->price;
      $product->category = $eloquent->category;
      $product->description = $eloquent->description;
      $product->size = $eloquent->size;
      $product->color = $eloquent->color;
      $product->suplier = $eloquent->suplier;
      $product->amount = $eloquent->amount;
      $product->imgPath = $eloquent->imgPath;
      $product->has_promotion = $eloquent->has_promotion;
      $product->promotion = $eloquent->promotion;
      $product->pro_percent = $eloquent->pro_percent;
      $product->adapter_type = $eloquent->adapter_type;

      return $product;
    }
    return null;
  }

  /**
   * Gets the value of price.
   *
   * @return mixed
   */
  public function getProductName()
  {
    return $this->product_name;
  }
  
  /**
   * Sets the value of price.
   *
   * @param mixed $price the price 
   *
   * @return self
   */
  public function setProductName($product_name)
  {
    $this->product_name = $product_name;

    return $this;
  }

  /**
   * Gets the value of price.
   *
   * @return mixed
   */
  public function getPrice()
  {
    return $this->price;
  }
  
  /**
   * Sets the value of price.
   *
   * @param mixed $price the price 
   *
   * @return self
   */
  public function setPrice($price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Gets the value of category.
   *
   * @return mixed
   */
  public function getCategory()
  {
    return $this->category;
  }
  
  /**
   * Sets the value of category.
   *
   * @param mixed $category the category 
   *
   * @return self
   */
  public function setCategory($category)
  {
    $this->category = $category;

    return $this;
  }

  /**
   * Gets the value of description.
   *
   * @return mixed
   */
  public function getDescription()
  {   
    return $this->description;
  }
  
  /**
   * Sets the value of description.
   *
   * @param mixed $description the description 
   *
   * @return self
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Gets the value of size.
   *
   * @return mixed
   */
  public function getSize()
  {
    return $this->size;
  }
  
  /**
   * Sets the value of size.
   *
   * @param mixed $size the size 
   *
   * @return self
   */
  public function setSize($size)
  {
    $this->size = $size;

    return $this;
  }

  /**
   * Gets the value of color.
   *
   * @return mixed
   */
  public function getColor()
  {
    return $this->color;
  }
  
  /**
   * Sets the value of color.
   *
   * @param mixed $color the color 
   *
   * @return self
   */
  public function setColor($color)
  {
    $this->color = $color;

    return $this;
  }

  /**
   * Gets the value of suplier.
   *
   * @return mixed
   */
  public function getSuplier()
  {
    return $this->suplier;
  }
  
  /**
   * Sets the value of suplier.
   *
   * @param mixed $suplier the suplier 
   *
   * @return self
   */
  public function setSuplier($suplier)
  {
    $this->suplier = $suplier;

    return $this;
  }

  /**
   * Gets the value of amount.
   *
   * @return mixed
   */
  public function getAmount()
  {
    return $this->amount;
  }
  
  /**
   * Sets the value of amount.
   *
   * @param mixed $amount the amount 
   *
   * @return self
   */
  public function setAmount($amount)
  {
    $this->amount = $amount;

    return $this;
  }

   /**
   * Gets the value of amount.
   *
   * @return mixed
   */
  public function getImgPath()
  {
    return $this->imgPath;
  }
  
  /**
   * Sets the value of amount.
   *
   * @param mixed $amount the amount 
   *
   * @return self
   */
  public function setImgPath($imgPath)
  {
    $this->imgPath = $imgPath;
    return $this;
  }

  public function setId($id){
    $this->id = $id;
  }
  
  /**
   * Get id.
   *
   * @return id.
   */
  public function getId()
  {
    return $this->id;
  }

  /**
  *  Promotion Logic 
  *
  */
  public function getProPercent()
  {
    // Check Is promotion adapter instantiate.
    if($this->promotion instanceof \core\IPromotionAdapter){
        return $this->promotion->getPro_percent();
    }else return 0;
  }

  public function setProPercent($percent)
  {
    $this->promotion->setPro_percent($percent);
  }

  public function setXYparams($str_xy)
  {
    $this->XY_params = $str_xy;
  }

  public function getXYparams()
  {
    return $this->XY_params;
  }

  public function setAdapterType($adapter)
  {
    $this->adapter_type = $adapter;
  }

  public function getAdapterType() 
  {
    return $this->adapter_type;
  }

  //set Adapter ,What promotion for this product
  public function setPromotionAdapter(\core\IPromotionAdapter $promotion)
  {
    $this->promotion = $promotion;
    $this->has_promotion = true;
  }

  //set information for execute promotion.
  // On Discount  : first = percent , second = old_price 
  // On buyXFreeY : first = "buy,free" , second = old_price
  public function setPromotion($first,$second)
  {
    $this->promotion->setPromotion($first,$second);
    //product Id for identify products
    $this->promotion->setProductId($this->id);
  }
  
  // for checking user's promotion ,are they reached the condition. 
  public function isGotPromotion()
  {
    return $this->promotion->checkCondition()?true:false;
  }

  // Execute Promotion then return new price.
  public function executePromotion(){
    if($this->isGotPromotion()){
      return $this->promotion->getPromotionPrice();   
    }
  }
}
