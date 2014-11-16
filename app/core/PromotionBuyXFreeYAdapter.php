<?php
namespace core;
class PromotionBuyXFreeYAdapter implements IPromotionAdapter
{
  protected $buy = 0;
  protected $free = 0;
  protected $old_price = 0;
  protected $pro_id;
  protected $new_price;

  public function setPromotion($XY_params,$old_price)
  {
    $XY_arr = explode(',',$XY_params);
    $this->buy = $XY_arr[0];
    $this->free = $XY_arr[1];
    $this->old_price = $old_price;
  }

  public function checkCondition()
  {
    $id = $this->pro_id;
    $cookie = json_decode($_COOKIE['products']);

    foreach($cookie as $cookieProduct) {
      if($cookieProduct->id == $id){
        if($cookieProduct->amount >= $this->buy){
          $x = $this->buy;
          $y = $this->free;

          //calculate price of product which being buy as a set.
          $this->new_price = $this->old_price * $x * floor($cookieProduct->amount/($x+$y));
          //calculate price of product in full price.
          $this->new_price += $this->old_price * ($cookieProduct->amount%($x+$y));
          //find the average price per unit
          $this->new_price = $this->new_price/$cookieProduct->amount;

          return true;
        }
      }
    }
    return false;
  } 

  public function getPromotionPrice()
  {
    //check Is this product catch a promotion.
    if($this->checkCondition())return $this->new_price; //God!! it's free XD
    else return $this->old_price; 
  }

  public function setProductId($id)
  {
    $this->pro_id = $id;
  }

  public function getBuy()
  {
    return $this->buy;
  }

  public function getFree()
  {
    return $this->free;
  }
}
