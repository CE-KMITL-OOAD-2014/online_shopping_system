@extends('template.shopStructure')
@section('shopContent')

		<div class="panel panel-success">
		  <div class="panel-heading">
		    <h3 class="panel-title">รายการการสั่งซื้อ</h3>
		  </div>
		  <div class="panel-body well">
		  	<p style = "text-align: center;" >ขอขอบคุณที่เชื่อมั่นในสินค้าของ Sellon <br />
			สถานะการสั่งซื้อ ของคุณ {{ Auth::user()->username }} <br/>

		  	</p>
				@foreach ($orders as $order) 
				<div class="panel panel-default col-md-4">
				 <div class="panel-body">
				  	<b>Order Status</b> 
				  	@if ($order->status == 1)
				  		<span class="label label-success">จัดส่งแล้ว</span>
					@else
						<span class="label label-warning">อยู๋ระหว่างการจัดส่ง</span>	
				  	@endif
				  	<br />
					<b>Order Id</b> {{ $order->id }} <br />
					<b>Total</b> {{ $order->total_price }} <br />
					<b>Order Time</b> {{ $order->created_at }}<br />
					<b>Products</b> <br />
				  </div>
				</div>	
				@endforeach
		  </div>
		</div>
@stop
@section('nav/order')
active
@stop