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
              <input type="checkbox" value="{{$productFromDB->getId()}}" onchange="productSelect()"/>
              {{ $productFromDB->getProductName() }}
            </td>

            <td>
              <input type="number" class="col-md-8" name="buy-amount" min="1" max="{{$productFromDB->getAmount()}}" 
                id="{{ $productFromDB->getProductName()}}-buy-amount" 
                onchange="changeAmount(this, '{{$productFromDB->getProductName()}}', {{$productFromDB->getId()}})" 
                value="{{ $product->amount }}">
                <!-- ^ user select amount, so using value from cookie instead of DB-->
            </td>

            <td id="{{ str_replace(' ','',$product->name) }}-total-price">
              <!-- different price for different promotion type -->
              @if($productFromDB->getAdapterType()=="PromotionDiscountAdapter")
                {{ $productFromDB->executePromotion() * $product->amount }}
              @elseif($productFromDB->getAdapterType()=="PromotionBuyXFreeYAdapter")
                {{ (($productFromDB->isGotPromotion())?$productFromDB->executePromotion():$productFromDB->getPrice()) * $product->amount }}
              @else
                {{ $productFromDB->getPrice() * $product->amount }}
              @endif
            </td>
          </tr>

          <!-- hidden input to keep track of some data for price calculation -->
          @if(isset($productFromDB))
            @if($productFromDB->getAdapterType()=="PromotionDiscountAdapter")
              <input type="hidden" name="" id="{{ str_replace(' ', '', $product->name) }}-promotion-price" 
               value="{{$productFromDB->executePromotion()}}" />
            @elseif($productFromDB->getAdapterType()=="PromotionBuyXFreeYAdapter")
              <input type="hidden" name="" id="{{ str_replace(' ', '', $product->name) }}-promotion-xy" 
                value="{{$productFromDB->getXYparams()}}" />
            @endif
              <input type="hidden" name="" id="{{ str_replace(' ', '', $product->name) }}-price" 
                value="{{ $productFromDB->getPrice() }}" />
          @endif

        @endforeach
      </table>

      <button class="btn btn-success" data-toggle="modal" data-target="#confirm" 
        onclick="{{isset($user)?'checkStock()':'location.href=\'/login\''}}">Buy</button></a>
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
                {{ $product->name }}
              </td>
              <td id="{{$product->name}}-amount-modal">
                {{ $product->amount }}
              </td>
              <td id="{{$product->name}}-total-price-modal">
                <!-- use discounted price if exist -->
                {{ ($productRepo->find($product->id)->getAdapterType()!="")?$productRepo->find($product->id)->executePromotion():
                  $productRepo->find($product->id)->getPrice() * $product->amount; }}
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
  <script type="text/javascript" charset="utf-8" src="{{url('js/cart.js')}}"></script>
@stop
