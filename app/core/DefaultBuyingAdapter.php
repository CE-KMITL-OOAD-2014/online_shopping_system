<?php
namespace core;
class DefaultBuyingAdapter implements IBuyingAdapter
{
  protected $order_repo;
  protected $product_repo;
  public function __construct($order_repo, $product_repo)
  {
    $this->order_repo = $order_repo;
    $this->product_repo = $product_repo;
  }

  Public function buy($products, $user)
  {
    $total_price = 0.0;
    foreach($products as $product){
      $total_price+= $product->getPrice();
    }

    $order = new Order();
    $order->setTotal_price($total_price);
    $order->setUser_id($user->getId());
    $this->order_repo->save($order);
  }
}
