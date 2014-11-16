<?php
namespace core;
interface IPromotionAdapter
{
  public function setPromotion($percent,$old_price);
  public function checkCondition();
  public function getPromotionPrice();
  public function setProductId($id);
}

