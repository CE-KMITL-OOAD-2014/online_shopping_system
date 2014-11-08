@extends('template.shopStructure')
@section('shopContent')
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">สินค้าในร้านค้า</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="row">
		    @foreach ($products as $product)
				  <div class="col-sm-6 col-md-4">
				    <div class="thumbnail">
				      <img src="{{ asset('img/'.$product->imgPath) }}" />
				      <div class="caption">
				        <h3>{{ $product->product_name }}</h3>
				        <h5> ราคา : {{ $product->price }} บาท </h5>
				        <p>{{ $product->description }}</p>
				        <p id="amount">เหลืออีก {{ $product->amount }}</p>
				        <p>  </p>
				        <p style = "text-align:center" >
                                        <input type="hidden" name="" id="{{ $product->product_name }}-max" value="{{ $product->amount }}" />
                                        <button class="btn btn-primary" data-toggle="modal"
                                           data-target="#add-cart" onclick="addToCart({{ $product->product_name }})">เพิ่มลงในตะกร้า</button>
                                        <br>
                                        <br>
                                        <a href="{{ URL::to('shop/'.$product->id.'/view') }}" class="btn btn-default" role="button">รายละเอียด</a>
				        </p>
				      </div>
				    </div>
				  </div>
		    @endforeach
		    	</div>
		  </div>
		</div>

  <div class="modal fade" id="add-cart">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title">เพิ่มลงตะกร้า</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>ชื่อสินค้า</th>
              <th>จำนวน</th>
              <th>ราคารวม</th>
            </tr>
            <tr>
              <td>
                <span id="product-name"></span>
              </td>
              <td>
                <input type="number" class="col-md-8" name="buy-amount" 
                  id="buy-amount" value="1" min="0" onchange="changeAmount(this)"
                  max="1"/>
              </td>
              <td id="total-price">
                <!-- product name goes here -->
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="addToCart()" class="btn btn-warning"
            data-dismiss="modal">
            ยืนยัน
          </button></div>
      </div>
    </div>
  </div>

@stop
@section('script')
  @parent
  <script type="text/javascript" charset="utf-8">
    var cookieArr;
    var cartProductAmount = 0;
    var currentProductName = "";

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

    function addToCart(name)
    {
      currentProductName = name;
      $('#product-name').val(name);
      console.log('currentProduct');
      console.log(currentProductName);
      var tmpCookie = getCookie("products");
      console.log(tmpCookie);
      var expires = new Date();
      expires.setFullYear((expires.getFullYear()+5) );

      var length = cookieArr.length;
      for(var i=0; i<=length ; i++)
      {
        if(i == length)
        {
          cookieArr.push({id: {{ $product->id }}, name: currentProductName, amount:  parseInt(document.getElementById("buy-amount").value)});
          cartProductAmount = cookieArr[i].amount;
        }
        else if( cookieArr[i].id == {{ $product->id }} ){
          cookieArr[i].amount = parseInt(document.getElementById("buy-amount").value);
          cartProductAmount = cookieArr[i].amount;
          break;
        }
      }
  
      console.log("cartAmount");
      console.log(cartProductAmount);

      if(cartProductAmount == {{$product->amount }}){
        console.log(name + "max-amount");
        document.getElementById(name + "max-amount").value = 0;
        document.getElementById(name + "buy-amount").setAttribute("max", 0);
      }

      document.getElementById("buy-amount").setAttribute("max", 
        parseInt(document.getElementById("buy-amount").getAttribute("max")) - 
        parseInt(document.getElementById("buy-amount").value)
      );

      //if(cartProductAmount == {{$product->amount }}){
      //  document.getElementById("buy-amount").setAttribute('value', 0);
      //}

      console.log(JSON.stringify(cookieArr));

      document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
        + expires.toGMTString() + "; path=/;";
      console.log(document.cookie);
    }


  </script>
@stop
