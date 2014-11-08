@extends('template.shopStructure')
@section('shopContent')
  <img src = "{{ asset('img/'.$product->getImgPath()) }}" />
  <div class ="col-md-8">
          <span id="product-name">{{ $product->getProductName() }}</span> <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-cart">
      เพิ่มลงในตะกร้า
    </button>
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
                {{ $product->getProductName() }} 
              </td>
              <td>
                <input type="number" class="col-md-8" name="buy-amount" 
                  id="buy-amount" value="1" min="0" onchange="changeAmount(this)"
                  max="1"/>
              </td>
              <td id="total-price">
                {{ $product->getPrice() }}
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
        if( cookieArr[i].id == {{ $product->getId() }})
        {
          cartProductAmount = cookieArr[i].amount;
          break;
        }
      }

      document.getElementById("buy-amount").setAttribute( 'max', {{ $product->getAmount() }} - cartProductAmount);
      if(cartProductAmount == {{$product->getAmount()}}){
        document.getElementById("buy-amount").setAttribute('value', 0);
      }
    }

    function addToCart()
    {
      var tmpCookie = getCookie("products");
      console.log(tmpCookie);
      var expires = new Date();
      expires.setFullYear((expires.getFullYear()+5) );

      var length = cookieArr.length;
      for(var i=0; i<=length ; i++)
      {
        if(i == length)
        {
          cookieArr.push({ id: {{ $product->getId() }}, name: "{{ $product->getProductName() }}", amount:  parseInt(document.getElementById("buy-amount").value)});
          cartProductAmount = cookieArr[i].amount;
        }
        else if( cookieArr[i].id == {{ $product->getId() }} ){
          cookieArr[i].amount = parseInt(document.getElementById("buy-amount").value);
          cartProductAmount = cookieArr[i].amount;
          break;
        }
      }
  
      console.log("cartAmount");
      console.log(cartProductAmount);

      if(cartProductAmount == {{$product->getAmount()}}){
        console.log('eiei');
        document.getElementById("buy-amount").value = 0;
        document.getElementById("buy-amount").setAttribute("max", 0);
      }

      document.getElementById("buy-amount").setAttribute("max", 
        parseInt(document.getElementById("buy-amount").getAttribute("max")) - 
        parseInt(document.getElementById("buy-amount").value)
      );

      //if(cartProductAmount == {{$product->getAmount()}}){
      //  document.getElementById("buy-amount").setAttribute('value', 0);
      //}

      console.log(JSON.stringify(cookieArr));

      document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
        + expires.toGMTString() + "; path=/;";
      console.log(document.cookie);
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

  function changeAmount(amount)
  {
    console.log(amount.value);
    document.getElementById("total-price").innerHTML = amount.value * {{$product->getPrice()}};
  }
  </script>
@stop
