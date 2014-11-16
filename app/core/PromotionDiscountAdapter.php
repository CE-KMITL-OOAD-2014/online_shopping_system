<?php
namespace core;
class PromotionDiscountAdapter implements IPromotionAdapter
{
  protected $pro_price = 0;
  protected $pro_percent = 0;
  protected $old_price = 0;
  protected $pro_id;

  public function setPromotion($percent,$old_price) {
    //Calculate New Price 
    $this->pro_price = $old_price * (100-$percent)/100;
    // Collect Knowlege to Adapter 
    $this->pro_percent = $percent;
    $this->old_price = $old_price;
  }

  public function checkCondition() {
    // Nothing to check it's just discount
    return true;
  } 

  public function getPromotionPrice() {
    return $this->pro_price;
  }

  public function setProductId($id){
    $this->pro_id = $id;
  }


  public function getPro_percent(){
    return $this->pro_percent;
  }

  public function getPro_price() {
    return $this->pro_price;
  }

  public function setPro_percent($percent){
    $this->pro_percent = $percent;
  }

}
