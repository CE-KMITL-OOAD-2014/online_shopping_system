@extends('template.shopStructure')
@section('slideshow')
 <div class="col-md-14 well">
  <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
 	<div class="carousel-inner">
	  <div class="item active"> <img src="http://placehold.it/1000x300" style="width:100%"  alt="First slide">
	    <div class="container">
	      <div class="carousel-caption">
	        <h1> Headling 1 </h1>
	        <p> Description 1</p>
	      </div>
	    </div>
	  </div>
	  <div class="item"> <img src="http://placehold.it/1000x300" style="width:100%" data-src="" alt="Second slide">
	    <div class="container">
	      <div class="carousel-caption">
	        <h2>
	        Headling 2
	        </h1>
	        <p> Description 2</p>
	      </div>
	    </div>
	  </div>
	  <div class="item"> <img src="http://placehold.it/1000x300" style="width:100%" data-src="" alt="Third slide">
	    <div class="container">
	      <div class="carousel-caption">
	        <h2>
	        Headling 3
	        </h2>
	        <p> Description 3</p>
	      </div>
	    </div>
	  </div>
	</div>

	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
	  <span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	 
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
	  <span class="glyphicon glyphicon-chevron-right"></span>
	</a>

	<ol class="carousel-indicators">
  		<li data-target="#myCarousel" data-slide-to="1"></li>
  		<li data-target="#myCarousel" data-slide-to="2"></li>
  		<li data-target="#myCarousel" data-slide-to="3"></li>
	</ol>
   </div>
 </div>
@stop

@section('shopContent')

		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">สินค้าในร้านค้า</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="row">
		     @foreach ($products as $product)
				  <div class="col-sm-6 col-md-4">
				    <div classId="thumbnail" >
				      	<img src="{{ asset('img/'.$product->getImgPath()) }}" style="height:200px;" class ="img-responsive"/>
				      <div class="caption equal">
				        <h3>{{ $product->getProductName() }}</h3>
				        @if($product->getProPercent() != 0)
							<h5> ราคา : <del>{{ $product->getPrice() }}</del> บาท ลด <span class="label label-warning">{{ $product->getProPercent() }} % </span> </h5>
				        	<h6>เหลือ {{ $product->executePromotion() }} เท่านั้น</h6>
				        @else
				        	<h5> ราคา : {{ $product->getPrice() }} บาท </h5>
				        @endif 
                                        <input type="hidden" name="" id="{{ str_replace(' ', '', $product->getProductName()) }}-max" value="{{ $product->getAmount() }}" />
				        <p>{{ $product->getDescription() }}</p>
				        <p>เหลืออีก {{ $product->getAmount() }}</p>
				        <p style = "text-align:center" >
                                        <input type="hidden" name="" id="{{ str_replace(' ', '', $product->getProductName()) }}-price" value="{{ $product->getPrice() }}" />
                                        <input type="hidden" name="" id="{{ str_replace(' ', '', $product->getProductName()) }}-id" value="{{ $product->getId() }}" />
                                        <button class="btn btn-primary" data-toggle="modal"
                                           data-target="#add-cart" onclick="cartModal('{{ $product->getProductName() }}')">เพิ่มลงในตะกร้า</button>
                                        <br/><br/>
				        <a href="{{ URL::to('shop/'.$product->getId().'/view') }}" class="btn btn-default" role="button">รายละเอียด</a>
				        </p>
				      </div>
				    </div>
				  </div>
		    @endforeach
		    	</div>
		  </div>
		</div>
@stop

@section('second-content')
	<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"> สินค้า Promotion</h3>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    @foreach ($pro_product as $product)
				  <div class="col-sm-6 col-md-4">
				    <div classId="thumbnail">
				      	<img src="{{ asset('img/'.$product->getImgPath()) }}" style="height:200px;"/>
				      <div class="caption">
				        <h3>{{ $product->getProductName() }}</h3>
				        <h5> ราคา : <del>{{ $product->getPrice() }}</del> บาท ลด <span class="label label-warning">{{ $product->getProPercent() }} % </span> </h5>

				        <h6>เหลือ {{ $product->executePromotion() }} เท่านั้น</h6> 
				        <p>{{ $product->getDescription() }}</p>
				        <p id="{{$product->getProductName()}}-amount">เหลืออีก {{ $product->getAmount() }}</p>
				        <!--<p>  </p> -->
				        <p style = "text-align:center" >
                                        <button class="btn btn-primary" data-toggle="modal"
                                           data-target="#add-cart" onclick="cartModal('{{ $product->getProductName() }}')">เพิ่มลงในตะกร้า</button>
                                        <br>
                                        <br>
                                        <a href="{{ URL::to('shop/'.$product->getId().'/view') }}" class="btn btn-default" role="button">รายละเอียด</a>
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
          <button type="button" class="close" data-dismiss="modal" onclick="clearval()">
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
                <span id="product-name">
                  <!-- product name goes here -->
                </span>
              </td>
              <td>
                <input type="number" class="col-md-8" name="buy-amount" 
                  id="buy-amount" value="1" min="0" onchange="changeAmount(this)"
                  max="1"/>
              </td>
              <td id="total-price">
                <!-- product price goes here -->
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

    function clearval()
    {
      console.log('eiei');
      console.log($('#buy-amount').val());
      $('#buy-amount').val(1);
    }

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

    function cartModal(name)
    {
      console.log(name);
      currentProductName = name;
      $('#product-name').html(currentProductName);
      console.log('currentProduct');
      console.log(currentProductName);

      console.log(currentProductName.replace(/\s+/g,'') + "-max");
      console.log($("#" + currentProductName.replace(/\s+/g,'') + "-max"));
      console.log('bug');
      console.log($("#" + currentProductName.replace(/\s+/g,'') + "-max").val());

      console.log($('#buy-amount'));
      console.log($('#buy-amount').attr('max'));


      $('#buy-amount').attr('max', $('#' + currentProductName.replace(/\s+/g, "") + "-max").val());

      $('#total-price').html($('#' + currentProductName.replace(/\s+/g, "") + "-price").val());
    }

    function changeAmount(amount) {
      console.log(amount.value);
      console.log($('#' + currentProductName + "-price").val());
      console.log(amount.value);
      console.log(amount.value * $('#' + currentProductName + "-price").val());
      $("#total-price").html(amount.value * $('#' + currentProductName.replace(/\s+/g, "") + "-price").val());
      console.log($('#total-price').html);
    }


  function addToCart(name)
  {
    var tmpCookie = getCookie("products");
    console.log(tmpCookie);
    var expires = new Date();
    expires.setFullYear((expires.getFullYear()+5) );

    console.log("pro name add to cart");
    console.log(currentProductName);

    var length = cookieArr.length;
    for(var i=0; i<=length ; i++)
    {
      if(i == length)
      {
        console.log("eieieiei");
	console.log("id");
	console.log($('#'+ currentProductName.replace(/\s+/g,'') +'-id').val());
        cookieArr.push({id: $('#'+ currentProductName.replace(/\s+/g,'') + '-id').val(), name: currentProductName, amount:  parseInt(document.getElementById("buy-amount").value)});
        cartProductAmount = cookieArr[i].amount;
      }
      else if( cookieArr[i].id == $('#'+currentProductName+'-id').val() ){
	console.log("exist");
        cookieArr[i].amount = parseInt(document.getElementById("buy-amount").value);
        cartProductAmount = cookieArr[i].amount;
        break;
      }

    console.log(JSON.stringify(cookieArr));

    document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
      + expires.toGMTString() + "; path=/;";
    console.log(document.cookie);
    clearval();
    }
}

  </script>

@stop
