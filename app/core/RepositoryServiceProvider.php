<?php 
namespace core;

use Illuminate\Support\ServiceProvider;

Class RepositoryServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->bind('\core\EloProductRepo','\core\ProductRepoInterface');
    $this->app->bind('\core\EloOrderRepo','\core\IOrderRepo');
    $this->app->bind('\core\IBuyingAdapter', '\core\DefaultBuyingAdapter');
    $this->app->bind('\core\IPromotionAdapter','\core\PromotionDiscountAdapter');
  }
}
