@extends('template.shopStructure')
@section('shopContent')

		<div class="panel panel-success">
		  <div class="panel-heading">
		    <h3 class="panel-title">รายการการสั่งซื้อ</h3>
		  </div>
		  <div class="panel-body">
		  	<p style = "text-align: center;" >ขอขอบคุณที่เชื่อมั่นในสินค้าของ Sellon <br />
			สถานะการสั่งซื้อ ของคุณ ... <br/>

		  	</p>

		  	<div class="panel panel-default col-md-4">
			  <div class="panel-body">
			  	<b>Order Status</b> <span class="label label-success">จัดส่งแล้ว</span> <br />
				<b>Order Id</b> <br />
				<b>Customer</b> <br />
				<b>Total</b> <br />
				<b>Order Time</b> <br />
				<b>Products</b> <br />
			  </div>
			</div>

			<div class="panel panel-default col-md-4">
			  <div class="panel-body">
			  	<b>Order Status</b> <span class="label label-danger">สินค้ามีปัญหา</span> <br />
				<b>Order Id</b> <br />
				<b>Customer</b> <br />
				<b>Total</b> <br />
				<b>Order Time</b> <br />
				<b>Products</b> <br />
			  </div>
			</div>

		  </div>
		</div>
@stop