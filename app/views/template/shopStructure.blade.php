@extends('template.structure')
@section('content')
	<div class = "col-md-4 well">
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title">navbar</h3>
		  </div>
		  <div class="panel-body">
		    <ul class="nav nav-pills nav-stacked" >
				<li ><a href = "{{ URL::to('/'); }}" >Home</a></li>
				<li ><a href = "{{ URL::to('shop/order'); }}">Check Order</a></li>
				<li ><a href = "{{ URL::to('shop/contactUs'); }}">Contact Us</a></li>
				<li ><a href = "{{ URL::to('shop/chat'); }}">Chat with other people</a></li>
			</ul>
		  </div>
		</div>
	</div>	
	<div class = "col-md-8 well">
		@yield('shopContent')
	</div>
@stop
