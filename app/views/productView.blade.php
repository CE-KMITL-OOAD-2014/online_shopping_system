@extends('template.structure')
@section('content')
@foreach($products as $product)
	{{ $product->price }}
@endforeach
	{{-- 
		
		protected $price;
		protected $category;
		protected $description;
		protected $size;
		protected $color;
		protected $suplier;
		protected $amount;
		 
		--}}

	{{ Form::open(array('url' => 'product')) }}
		{{Form::label('price')}} 
		{{ Form::text('price','' ,array('class' => 'form-control')) }}<br>
		
		{{Form::label('category')}} 
		{{ Form::text('category','' ,array('class' => 'form-control')) }} <br>	

		{{Form::label('description')}} 
		{{ Form::text('description','' ,array('class' => 'form-control')) }} <br>

		{{Form::label('size')}} 
		{{ Form::text('size','' ,array('class' => 'form-control')) }} <br>
	
		{{Form::label('color')}} 
		{{ Form::text('color','' ,array('class' => 'form-control')) }} <br>

		{{Form::label('suplier')}} 
		{{ Form::text('suplier','' ,array('class' => 'form-control')) }} <br>

		{{Form::label('amount')}} 
		{{ Form::text('amount','' ,array('class' => 'form-control')) }} <br>

		{{ Form::submit('ยืนยัน',array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
@stop
