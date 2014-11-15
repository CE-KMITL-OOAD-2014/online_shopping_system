<?php
namespace core;
class PromotionBuyXFreeYAdapter implements IPromotionAdapter
{
  protected $buy = 0;
  protected $free = 0;
  protected $old_price = 0;
  protected $pro_id;

  public function setPromotion($XY_params,$old_price) {
    $XY_arr = explode(',',$XY_params);
    $this->buy = $XY_arr[0];
    $this->free = $XY_arr[1];
    $this->old_price = $old_price;
  }

  public function checkCondition() {
    $id = $this->pro_id;
    // Neno you should doing here ####################################
    // Check number of Product from $id << This is promotion product's id
    //  return true if match promotion ....
    return false;
  } 

  public function getPromotionPrice() {
    //check Is this product catch a promotion.
    if(checkCondition())return 0; //God!! it's free XD
    else return $this->old_price; 
  }

  public function setProductId($id){
    $this->pro_id = $id;
  }

  public function getBuy(){
    return $this->buy;
  }

  public function getFree(){
    return $this->free;
  }


}
