<?php
namespace core;
class PromotionDiscountAdapter implements IPromotionAdapter
{
  protected $pro_price = 0;


  public function setPromotion($percent,$old_price) {
    //Calculate New Price 
    $this->pro_price = $old_price * (100-$percent)/100;
  }

  public function checkCondition() {
    // Nothing to check it's just discount
    return true;
  } 

  public function getPromotionPrice() {
    return $this->pro_price;
  }

}
