@extends('template.shopStructure')
@section('shopContent')

  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title">รายการการสั่งซื้อ</h3>
    </div>

    <div class="panel-body well">
      <p style = "text-align: center;" >ขอขอบคุณที่เชื่อมั่นในสินค้าของ Sellon <br />
	สถานะการสั่งซื้อ ของคุณ {{ Auth::user()->username }} <br/>
	หมายเหตุ ** ท่านสามารถติดตามพัสดุ EMS ได้ผ่านทาง <a href="http://track.thailandpost.co.th/tracking/default.aspx" >ที่นี่</a>
      </p>
      @foreach ($orders as $order) 
        <div class="panel panel-default col-md-4">
          <div class="panel-body">
            <b>Order Status</b><br/> 
	    @if ($order->getStatus() == 1)
	      <span class="label label-success">จัดส่งแล้ว</span>
	    @else
	      <span class="label label-warning">อยู๋ระหว่างการจัดส่ง</span>	
	    @endif
	    <br />
	    <b>Order Id</b> {{ $order->getId() }} <br />
	    <b>Total</b> {{ $order->getTotal_price() }} <br />
	    <b>Order Time</b> {{ $order->getOrder_time() }}<br />
	    <b>Products</b> <br />
	    <ul>
              <div style = "height:70px;overflow:scroll;overflow-x:hidden;">
                @foreach($order->getProducts() as $product)
                  <li> {{ $product->getProductName() }} </li>
                @endforeach
              </div>
            </ul>
            <b>EMS</b>
            {{ $order->getEms() }}
	  </div>
	</div>	
      @endforeach
    </div>
  </div>
@stop
@section('nav/order')
active
@stop
