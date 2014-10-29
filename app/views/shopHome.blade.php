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
				        <p>เหลืออีก {{ $product->amount }}</p>
				        <p>  </p>
				        <p style = "text-align:center" ><a href="#" class="btn btn-primary" role="button">เพิ่มลงในตะกร้า</a></p>
				      </div>
				    </div>
				  </div>
		    @endforeach
		    	</div>
		  </div>
		</div>
@stop