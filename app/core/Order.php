<?php 
namespace core;

class Order 
{
  protected $id;
  protected $user_id;
  protected $total_price;
  protected $order_time;
  protected $status;
  protected $products;

  public function __construct()
  {
    $this->id = 0;
    $this->total_price = 0;
    $this->order_time = new \DateTime();
    $this->status = 0;
    $this->products = array();
  }

  public function setId($id)
  {
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
   * Get user_id.
   *
   * @return user_id.
   */
  public function getUser_id()
  {
      return $this->user_id;
  }
  
  /**
   * Set user_id.
   *
   * @param user_id the value to set.
   */
  public function setUser_id($user_id)
  {
      $this->user_id = $user_id;
  }
  
  /**
   * Get total_price.
   *
   * @return total_price.
   */
  public function getTotal_price()
  {
      return $this->total_price;
  }
  
  /**
   * Set total_price.
   *
   * @param total_price the value to set.
   */
  public function setTotal_price($total_price)
  {
      $this->total_price = $total_price;
  }
  
  /**
   * Get order_time.
   *
   * @return order_time.
   */
  public function getOrder_time()
  {
      return $this->order_time;
  }
  
  /**
   * Set order_time.
   *
   * @param order_time the value to set.
   */
  public function setOrder_time($order_time)
  {
      $this->order_time = $order_time;
  }
  
  /**
   * Get product_id.
   *
   * @return product_id.
   */
  public function getProduct_id()
  {
      return $this->product_id;
  }
  
  /**
   * Set product_id.
   *
   * @param product_id the value to set.
   */
  public function setProduct_id($product_id)
  {
      $this->product_id = $product_id;
  }
  
  /**
   * Get status.
   *
   * @return status.
   */
  public function getStatus()
  {
      return $this->status;
  }
  
  /**
   * Set status.
   *
   * @param status the value to set.
   */
  public function setStatus($status)
  {
      $this->status = $status;
  }
    
    /**
     * Get products.
     *
     * @return products.
     */
    public function getProducts()
    {
        return $this->products;
    }
    
    /**
     * Set products.
     *
     * @param products the value to set.
     */
    public function addProduct(Product $product)
    {
        array_push($this->products, $product);
    }

    

    /**
  * Change User id to user his/her name.
  */
  public function getNamefromId(){
    $user = \User::find($this->user_id);
    return $user->username;
  }
}
