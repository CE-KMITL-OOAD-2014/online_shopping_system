<?php
namespace core;
class EloOrderRepo implements IOrderRepo {
  protected $eloOrder;

  public function __construct(\Order $eloOrder)
  {
    $this->eloOrder = $eloOrder;
  }

  public function save(Order $order) 
  {
    $existOrder = \Order::find($order->getId());
    if($existOrder != null){
      $existOrder->total_price = $order->getTotal_price();
      $existOrder->order_time = $order->getOrder_time();
      $existOrder->status = $order->getStatus();

      foreach($order->getProducts() as $product){
        $this->eloOrder->products()->save(\Product::find(product.getId()));
      }
    } else {
      $this->eloOrder->user_id = $order->getUser_id();
      $this->eloOrder->total_price = $order->getTotal_price();
      $this->eloOrder->order_time = $order->getOrder_time();
      $this->eloOrder->status = $order->getStatus();
      $this->eloOrder->save();

      foreach($order->getProducts() as $product){
        $this->eloOrder->products()->save(\Product::find(product.getId()));
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
      array_push($order->products, $product);
    }
    return $order;
  }
}
