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
    $order = new Order();
    $total_price = 0.0;
    $order->setUser_id($user->getId());

    foreach($products as $product){
      $productDB = $this->product_repo->find($product->getId());
      //use promotion price if exist. Otherwise, use normal price.
      $total_price += ($productDB->getAdapterType()!="")?$productDB->executePromotion():$productDB->getPrice() * $product->getAmount();

      $productDB->setAmount($productDB->getAmount() - $product->getAmount());
      $order->addProduct($productDB);
      $this->product_repo->saveId($productDB, $productDB->getId());
    }

    $order->setTotal_price($total_price);
    $this->order_repo->save($order);
  }
}
