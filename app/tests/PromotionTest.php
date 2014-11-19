<?php
class PromotionTest extends TestCase 
{
  public function setUp()
  {
    parent::setUp();
    
    Artisan::call('migrate');
    $this->seed();
  }
  public function testSetPromotion()
  {
    $product = Mockery::mock('\core\Product')->makePartial();
    $adapter = new \core\PromotionDiscountAdapter();
    $product->setPromotionAdapter($adapter);
    $price = 500;
    //in percent
    $discount = 5;
    $product->setPromotion($discount, $price);
    $this->assertEquals($product->executePromotion($discount, $price), $price-($price*$discount/100));
  }
}
