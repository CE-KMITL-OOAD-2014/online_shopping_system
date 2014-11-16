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

    <div class="panel-body well">
      <div class="row">
        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 " style = "text-align:center;" >
          <div classId="thumbnail" style="padding:8px;margin:-8px;" class ="panel" >
	    <div class = "equal">
              <img src="{{{ asset('img/'.$product->getImgPath()) }}}"  class ="img-responsive"/>
            </div>

            <div class="caption equal" style = "text-align:center;">
	      <h3>{{{ $product->getProductName() }}}</h3>
	      @if($product->getAdapterType() == "PromotionDiscountAdapter")
                <h5> ราคา : <del>{{{ $product->getPrice() }}}</del> บาท <br/> 
                ลด <span class="label label-warning">{{{ $product->getProPercent() }}} % </span> </h5>
                <h6>เหลือ {{{ $product->executePromotion() }}} เท่านั้น</h6>
	      @elseif($product->getAdapterType() == "PromotionBuyXFreeYAdapter")
	        <h5> ราคา : {{{ $product->getPrice() }}} บาท </h5>
                ซื้อ {{{explode(',',$product->getXYParams())[0]}}} แถม {{{explode(',',$product->getXYParams())[1]}}}
	      @endif
              <p>{{{ $product->getDescription() }}}</p>
	    </div>

            <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-max"
              value="{{{ $product->getAmount() }}}" />
            <b>เหลืออีก <span class="badge">{{{ $product->getAmount() }}}</span></b> 
            <p style = "text-align:center" >
            <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-price"
              value="{{{ $product->getPrice() }}}" />
            <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-id"
              value="{{{ $product->getId() }}}" />
            <button class="btn btn-primary" data-toggle="modal" data-target="#add-cart"
              onclick="cartModal('{{{ $product->getProductName() }}}')">เพิ่มลงในตะกร้า</button><br/><br/>
            <a href="{{{ URL::to('shop/'.$product->getId().'/view') }}}" class="btn btn-default" role="button">รายละเอียด</a>
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

    <div class="panel-body well">
      <div class="row">
      @foreach ($pro_product as $product)
        <div class="col-sm-6 col-md-3" style = "text-align:center;" >
          <div classId="thumbnail" class ="panel" >
            <div class = "equal" >
              <img src="{{{ asset('img/'.$product->getImgPath()) }}}"  class ="img-responsive"/>
            </div>

            <div class="caption equal" style = "text-align:center;">
              <h3>{{{ $product->getProductName() }}}</h3>
                @if($product->getAdapterType()=="PromotionDiscountAdapter")
                  <h5> ราคา : <del>{{{ $product->getPrice() }}}</del> บาท 
                  ลด <span class="label label-warning">{{{$product->getProPercent()}}}%</span> </h5>
                  <h6>เหลือ {{{ $product->executePromotion() }}} เท่านั้น</h6>
                  <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-promotion-price"
                    value="{{{$product->executePromotion()}}}" />
                @elseif($product->getAdapterType()=="PromotionBuyXFreeYAdapter")
                 <h5> ราคา : {{{ $product->getPrice() }}} บาท </h5>
                 <h6>ซื้อ {{{explode(',',$product->getXYParams())[0]}}} แถม {{{explode(',',$product->getXYParams())[1]}}}</h6>
                 <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-promotion-xy" 
                   value="{{{$product->getXYparams()}}}" />
                @endif
                </p>
              <p>{{{ $product->getDescription() }}}</p>
            </div>

            <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-max"
              value="{{{ $product->getAmount() }}}" />
            <b>เหลืออีก <span class="badge">{{{ $product->getAmount() }}}</span></b> 
            <p style = "text-align:center" >
            <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-price"
              value="{{{ $product->getPrice() }}}" />
            <input type="hidden" name="" id="{{{ str_replace(' ', '', $product->getProductName()) }}}-id"
              value="{{{ $product->getId() }}}" />
            <button class="btn btn-primary" data-toggle="modal"
              data-target="#add-cart" onclick="cartModal('{{{ $product->getProductName() }}}')">เพิ่มลงในตะกร้า</button>
                                        <br/><br/>
            <a href="{{{ URL::to('shop/'.$product->getId().'/view') }}}" class="btn btn-default" role="button">รายละเอียด</a>
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

@section('nav/home')
active
@stop

@section('script')
  @parent
  <script src="{{{ url('js/home.js') }}}"></script>
@stop
