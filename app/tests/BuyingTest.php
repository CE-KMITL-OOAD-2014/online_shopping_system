<?php
class BuyingTest extends TestCase 
{
  public function setUp()
  {
    parent::setUp();
    
    Artisan::call('migrate');
    $this->seed();
  }
  public function testBuying()
  {
    $userRepo = new core\EloUserRepo(new \User());
    $productRepo = new core\EloProductRepo(new \Product());
    $orderRepo = new core\EloOrderRepo(new \Order);
    $user = $userRepo->first();
    $buyingAdapter = new core\DefaultBuyingAdapter($orderRepo, $productRepo);
    $products = array();
    array_push($products, $productRepo->find(1)->setAmount(1), $productRepo->find(2)->setAmount(1), $productRepo->find(3)->setAmount(1));
    $user->buy($products, $buyingAdapter);
    $total_price = 0.0;
    foreach($products as $product)
    {
      $total_price = $total_price + $product->getPrice();
    }
    $order = $orderRepo->find(1);
    $this->assertEquals($order->getTotal_price(), $total_price);
  }
}
