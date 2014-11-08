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
				    <div class="thumbnail">
				      	<img src="{{ asset('img/'.$product->imgPath) }}" style="height:200px;"/>
				      <div class="caption">
				        <h3>{{ $product->product_name }}</h3>
				        <h5> ราคา : {{ $product->price }} บาท </h5>
				        <p>{{ $product->description }}</p>
				        <p>เหลืออีก {{ $product->amount }}</p>
				        <p style = "text-align:center" >
				        <a href="#" class="btn btn-primary" role="button">เพิ่มลงในตะกร้า</a> <br/><br/>
				        <a href="{{ URL::to('shop/'.$product->id.'/view') }}" class="btn btn-default" role="button">รายละเอียด</a>
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
		    Promotion
		  </div>
	</div>
@stop