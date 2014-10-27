@extends('template.structure')
@section('content')
	<div class = "col-md-4 well">
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title">navbar</h3>
		  </div>
		  <div class="panel-body">
		    <ul class="nav nav-pills nav-stacked" >
				<li ><a href = "{{ URL::to('shop/product'); }}" >Product</a></li>
				<li ><a href = "{{ URL::to('shop/order'); }}">Check Order</a></li>
				<li ><a href = "{{ URL::to('shop/aboutUs'); }}">Contact Us</a></li>
			</ul>
		  </div>
		</div>
	</div>	
	<div class = "col-md-8 well">
		@yield('shopContent')
	</div>
@stop