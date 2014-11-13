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
      <tr>
        <td>
          <input type="checkbox" value="{{$product->id}}" onchange="productSelect()"/>
          {{ $product->name }}
        </td>
        <td>
          <input type="number" class="col-md-8" name="buy-amount" min="1" max="{{$productRepo->find($product->id)->getAmount()}}" id="{{$productRepo->find($product->id)->getProductName()}}-buy-amount" onchange="changeAmount(this, '{{$product->name}}', {{$product->id}})" value="{{ $product->amount }}">
        </td>
        <td id="{{ $product->name }}-total-price">
          {{ $productRepo->find($product->id)->getPrice() * 
              $product->amount; }}
        </td>
      </tr>
          <input type="hidden" id="{{ $product->name }}-price" value="{{ $productRepo->find($product->id)->getPrice()}}">
      @endforeach
      </table>
      <button class="btn btn-success" data-toggle="modal" data-target="#confirm" onclick="checkStock()">Buy</button></a>
      <button id="remove-btn" class="btn btn-danger" style="display:none;" onclick="removeFromCart()"><span class="glyphicon glyphicon-trash"></span>Remove</button>
    </div>
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
                {{ $product->name }}
              </td>
              <td id="{{$product->name}}-amount-modal">
                {{ $product->amount }}
              </td>
              <td id="{{$product->name}}-total-price-modal">
                {{ $productRepo->find($product->id)->getPrice() * 
                    $product->amount; }}
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
      </div>
    </div>
  </div>
  
@stop
@section('script')
  @parent
  <script type="text/javascript" charset="utf-8">
    var cookieArr;

    window.onload = function ()
    {
      var tmpCookie = getCookie("products");
      if(tmpCookie == "") {
        cookieArr = new Array();
      } else {
        eval("cookieArr = " + tmpCookie );
      }

      for(var i=0; i < cookieArr.length; i++)
      {
          break;
      }
    }

    function checkStock()
    {
      for(var i=0; i<cookieArr.length; i++)
      {
        console.log(cookieArr[i]);
        $.get('api/product/'+cookieArr[i].id, function(result){
          checkStockCallback(JSON.parse(result));
        });
      }
    }

    function checkStockCallback(json){
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

      var expires = new Date();
      expires.setFullYear((expires.getFullYear()+5) );

      document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
        + expires.toGMTString() + "; path=/;";
    }

    function buy()
    {
      $.post('buy',function(result){
	console.log("result");
        console.log(result);
        clearval();
        window.location="{{ url('/')}}";
      });
    }

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
      $("#"+ productname +"-total-price").html(amount.value * $('#' + productname + "-price").val());
      $("#"+ productname +"-total-price-modal").html(amount.value * $('#' + productname + "-price").val());
      $("#"+ productname +"-amount-modal").html(amount.value);

      //console.log(cookieArr);
      for(var i=0; i<cookieArr.length; i++){
        if(cookieArr[i].id == id){
          console.log(cookieArr[i].amount);
          console.log(amount.value);
          cookieArr[i].amount = parseInt(amount.value);
          break;
        }
      }
      var expires = new Date();
      expires.setFullYear((expires.getFullYear()+5) );

      document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
        + expires.toGMTString() + "; path=/;";
    }

    function productSelect()
    {
      console.log($('input:checkbox:checked').val());
      if(typeof $('.table').find('input:checkbox:checked').val() != 'undefined'){
        $('#remove-btn').attr('style','');
      } else {
        $('#remove-btn').attr('style','display:none;');
      }
    }

    function removeFromCart()
    {
      $("input:checkbox:checked").each( function () {
        for(var i=0; i<cookieArr.length; i++){
          if(cookieArr[i].id = $(this).val()){
            cookieArr.splice(i,1);
            break;
          }
        }
      });
      var expires = new Date();
      expires.setFullYear((expires.getFullYear()+5) );

      document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
        + expires.toGMTString() + "; path=/;";
      window.location.reload();
    }

    function clearval(){
     $('#warning-msg').html('');
     $('#warning-msg').attr('style','display:none;');
    }
  </script>
@stop
