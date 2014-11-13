<?php
namespace core;
class EloOrderRepo implements IOrderRepo {
  protected $eloOrder;
  protected $eloOrderProduct;
  public function __construct(\Order $eloOrder)
  {
    $this->eloOrder = $eloOrder;
    $this->eloOrderProduct = new \OrderProduct();
  }

  public function save(Order $order) 
  {
    $existOrder = \Order::find($order->getId());
    if($existOrder != null){
      $existOrder->total_price = $order->getTotal_price();
      $existOrder->order_time = $order->getOrder_time();
      $existOrder->status = $order->getStatus();

      foreach($order->getProducts() as $product){
        $this->eloOrder->products()->save(\Product::find($product->getId()));
      }
    } else {
      $this->eloOrder->user_id = $order->getUser_id();
      $this->eloOrder->total_price = $order->getTotal_price();
      $this->eloOrder->order_time = $order->getOrder_time();
      $this->eloOrder->status = $order->getStatus();
      $this->eloOrder->save();

      foreach($order->getProducts() as $product){
        $this->eloOrder->products()->save(\Product::find($product->getId()));
      }
    }
  }

  public function find($id){
    $eloquent = \Order::find($id);
    $order = new Order();
    $order->setId($eloquent->id);
    $order->setUser_id($eloquent->user_id);
    $order->setTotal_price($eloquent->total_price);
    $order->setOrder_time($eloquent->order_time);
    $order->setStatus($eloquent->status);
    foreach($eloquent->products as $eloProduct){
      $product = new Product();
      $product->setId($eloProduct->id);
      $product->setProductName($eloProduct->product_name);
      $product->setPrice($eloProduct->price);
      $product->setCategory($eloProduct->category);
      $product->setDescription($eloProduct->description);
      $product->setSize($eloProduct->size);
      $product->setColor($eloProduct->color);
      $product->setSuplier($eloProduct->suplier);
      $product->setAmount($eloProduct->amount);
      $product->setImgPath($eloProduct->imgPath);
      $order->addProduct($product);
    }
    return $order;
  }

  public function all(){
      $value = $this->eloOrder->all();
      $orders = array();

      foreach ($value as $order) {
        $orderObj = new \core\Order();
        $orderObj->setId($order->id);
        $orderObj->setUser_id($order->user_id);
        $orderObj->setTotal_price($order->total_price);
        $orderObj->setOrder_time($order->order_time);
        $orderObj->setStatus($order->status);
        //$products = $this->eloOrderProduct->where('order_id',$order->id);
        //get product map with each order. 
        $products = $order->products()->get();
        foreach($products as $product){
          $product_obj = Product::newFromEloquent($product);
          $orderObj->addProduct($product_obj);
        }
        //TO DO ***** Array implement for product 
        $orders[] = $orderObj;
      }
      return $orders;
  }

  public function remove($id){
      $order = $this->eloOrder->find($id);
      $order->delete();
  }


  public function where($field,$value){
      return $this->eloOrder->where($field,$value)->get();
  }

}
