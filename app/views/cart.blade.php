@extends('template/shopStructure')
@section('shopContent')
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">สินค้าในตระกร้า</h3>
    </div>

    <div class="panel-body">
      <table class="table table-striped">
        <tr>
          <th>ชื่อสินค้า</th>
          <th>จำนวน</th>
          <th>ราคารวม</th>
        </tr>
        @foreach(json_decode(isset($_COOKIE['products'])?$_COOKIE['products']:'[]') as $product)
          <?php $productFromDB = $productRepo->find($product->id)?>
          <tr>
            <td>
              <input type="checkbox" value="{{{$productFromDB->getId()}}}" onchange="productSelect()"/>
              {{{ $productFromDB->getProductName() }}}
            </td>

            <td>
              <input type="number" class="col-md-8" name="buy-amount" min="1" max="{{{$productFromDB->getAmount()}}}" 
                id="{{{ $productFromDB->getProductName()}}}-buy-amount" 
                onchange="changeAmount(this, '{{{$productFromDB->getProductName()}}}', {{{$productFromDB->getId()}}})" 
                value="{{{ $product->amount }}}">
                <!-- ^ user select amount, so using value from cookie instead of DB-->
            </td>

            <td id="{{{ str_replace(' ','',$product->name) }}}-total-price">
              <!-- different price for different promotion type -->
              @if($productFromDB->getAdapterType()=="PromotionDiscountAdapter")
                {{{ $productFromDB->executePromotion() * $product->amount }}}
              @elseif($productFromDB->getAdapterType()=="PromotionBuyXFreeYAdapter")
                {{{ (($productFromDB->isGotPromotion())?$productFromDB->executePromotion():$productFromDB->getPrice()) * $product->amount }}}
              @else
                {{{ $productFromDB->getPrice() * $product->amount }}}
              @endif
            </td>
          </tr>

          <!-- hidden input to keep track of some data for price calculation -->
          @if(isset($productFromDB))
            @if($productFromDB->getAdapterType()=="PromotionDiscountAdapter")
              <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->name) }}}-promotion-price" 
               value="{{{$productFromDB->executePromotion()}}}" />
            @elseif($productFromDB->getAdapterType()=="PromotionBuyXFreeYAdapter")
              <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->name) }}}-promotion-xy" 
                value="{{{$productFromDB->getXYparams()}}}" />
            @endif
              <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->name) }}}-price" 
                value="{{{ $productFromDB->getPrice() }}}" />
          @endif

        @endforeach
      </table>

      <button class="btn btn-success" data-toggle="modal" data-target="#confirm" 
        onclick="{{{isset($user)?'checkStock()':'location.href=\'/login\''}}}">Buy</button></a>
      <button id="remove-btn" class="btn btn-danger" style="display:none;" onclick="removeFromCart()">
        <span class="glyphicon glyphicon-trash"></span>Remove</button>
    </div> <!-- panel body -->
  </div>

  <div class="modal fade" id="confirm">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title">ยืนยันการสั่งซื้อ</h4>
        </div>

        <div class="modal-body">
          <div id="warning-msg" class="alert alert-warning" style="display:none;"></div>
          <table class="table table-striped">
            <tr>
              <th>ชื่อสินค้า</th>
              <th>จำนวน</th>
              <th>ราคารวม</th>
            </tr>
            
            @foreach(json_decode(isset($_COOKIE['products'])?$_COOKIE['products']:'[]') as $product)
            <tr>
              <td>
                {{{ $product->name }}}
              </td>
              <td id="{{{$product->name}}}-amount-modal">
                {{{ $product->amount }}}
              </td>
              <td id="{{{$product->name}}}-total-price-modal">
                <!-- use discounted price if exist -->
                {{{ ($productRepo->find($product->id)->getAdapterType()!="")?$productRepo->find($product->id)->executePromotion():
                  $productRepo->find($product->id)->getPrice() * $product->amount }}}
              </td>
            </tr>
            @endforeach
          </table>
        </div>

        <div class="modal-footer">
          <button type="button" onclick="buy()" class="btn btn-success"
            data-dismiss="modal">
            ยืนยัน
          </button>
        </div>

      </div> <!-- modal content -->
    </div> <!-- model dialog -->
  </div>
@stop

@section('script')
  @parent
  <script type="text/javascript" charset="utf-8">
    //array which represent cart
    var cookieArr;

    //read cookie and store in cookieArr.
    window.onload = function ()
    {
      var tmpCookie = getCookie("products");
      if(tmpCookie == "") {
        cookieArr = new Array();
      } else {
        eval("cookieArr = " + tmpCookie );
      }
    
      for(var i=0; i < cookieArr.length; i++){
          break;
      }
    }
    
    //check if product still available.
    function checkStock()
    {
      for(var i=0; i<cookieArr.length; i++) {
        $.get('api/product/'+cookieArr[i].id, function(result){
          checkStockCallback(JSON.parse(result));
        });
      }
    }
    
    //edit amount in cart if greater than available amount of product
    function checkStockCallback(json)
    {
      for(var i=0; i<cookieArr.length; i++){
        if(cookieArr[i].id == json.id){
          if(cookieArr[i].amount > json.amount){
            cookieArr[i].amount = json.amount;
    	    $("#"+ json.product_name +"-amount-modal").html(json.amount);
            $("#"+ json.product_name + "-buy-amount").val(json.amount);
            $("#"+ json.product_name +"-total-price").html(json.amount * json.price);
	    $("#"+ json.product_name +"-total-price-modal").html(json.amount * json.price);

	    $('#warning-msg').attr('style','');
	    $('#warning-msg').html('มีสินค้าบางรายการที่มีจำนวนคงเหลือน้อยกว่าที่ลูกค้าต้องการสั่งซื้อ ต้องการดำเนินการต่อหรือไม่');
          }
          break;
        }
      }
      setCartToCookie();
    }

    function buy()
    {
      $.post('buy',function(result){
        clearval();
        window.location="{{{ url('/')}}}";
      });
    }

    //read cookie
    function getCookie(cname) 
    {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
      }
      return "";
    } 

    function changeAmount(amount, productname, id) {
      var realPrice=0;
      if(typeof $('#'+productname.replace(/\s+/g, "")+'-promotion-price').val() != 'undefined'){
        realPrice = $('#'+productname.replace(/\s+/g, "")+'-promotion-price').val();
        $("#"+productname.replace(/\s+/g, "")+"-total-price").html(realPrice*amount.value);
      } else if(typeof $('#'+productname.replace(/\s+/g, "")+'-promotion-xy').val() != 'undefined'){
        var x = parseInt($('#'+productname.replace(/\s+/g, "")+'-promotion-xy').val().split(',')[0]);
        var y = parseInt($('#'+productname.replace(/\s+/g, "")+'-promotion-xy').val().split(',')[1]);
        realPrice = $('#' +productname.replace(/\s+/g, "") + "-price").val() * x * Math.floor(amount.value/(x+y));
        realPrice += $('#' +productname.replace(/\s+/g, "") + "-price").val() * (amount.value%(x+y));
        realPrice=realPrice/amount.value;
        $("#"+productname.replace(/\s+/g, "")+"-total-price").html(Math.round(realPrice*amount.value));
      } else {
        realPrice = $('#' + productname.replace(/\s+/g, "") + "-price").val();
        $("#"+productname.replace(/\s+/g, "")+"-total-price").html(realPrice*amount.value);
      }
    
      for(var i=0; i<cookieArr.length; i++){
        if(cookieArr[i].id == id){
          cookieArr[i].amount = parseInt(amount.value);
          break;
        }
      }
      setCartToCookie();
    }
    
    function productSelect()
    {
      if(typeof $('.table').find('input:checkbox:checked').val() != 'undefined'){
        $('#remove-btn').attr('style','');
      } else {
        $('#remove-btn').attr('style','display:none;');
      }
    }
    
    function removeFromCart()
    {
      $("input:checkbox:checked").each( function () {
        //sequential search for selected product
        for(var i=0; i<cookieArr.length; i++){
          if(cookieArr[i].id == $(this).val()){
    	cookieArr.splice(i,1);
    	break;
          }
        }
      });
      setCartToCookie();
      window.location.reload();
    }
    
    
    function setCartToCookie()
    {
      var expires = new Date();
      expires.setFullYear((expires.getFullYear()+5) );
    
      document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
        + expires.toGMTString() + "; path=/;";
    }
    
    function clearval()
    {
     $('#warning-msg').html('');
     $('#warning-msg').attr('style','display:none;');
    }
  </script>
@stop
