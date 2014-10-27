@extends('template.structure')
@section('content')
{{-- product management sidebar --}}
	<div class = "col-md-4 well">
		<ul>
			<li>Product Management</li>
			<li>Order Management</li>
			<li>Inbox Management</li>	
			<li>User Management</li>
			<li>Logout</li>
		</ul>
	</div>
	<div class = "col-md-8 well">
		@yield('productContent')
	</div>
@stop