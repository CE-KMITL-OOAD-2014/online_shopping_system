@extends('template.structure')
@section('content')

	{{ Form::open(array('url' => 'product/'.$id.'/edit')) }}
		{{Form::label('price')}} 
		{{ Form::text('price', $product->getPrice() ,array('class' => 'form-control')) }}<br>
		
		{{Form::label('category')}} 
		{{ Form::text('category', $product->getCategory() ,array('class' => 'form-control')) }} <br>	

		{{Form::label('description')}} 
		{{ Form::text('description', $product->getDescription()  ,array('class' => 'form-control')) }} <br>

		{{Form::label('size')}} 
		{{ Form::text('size', $product->getSize() ,array('class' => 'form-control')) }} <br>
	
		{{Form::label('color')}} 
		{{ Form::text('color', $product->getColor() ,array('class' => 'form-control')) }} <br>

		{{Form::label('suplier')}} 
		{{ Form::text('suplier', $product->getSuplier()  ,array('class' => 'form-control')) }} <br>

		{{Form::label('amount')}} 
		{{ Form::text('amount', $product->getAmount()  ,array('class' => 'form-control')) }} <br>

		{{ Form::submit('ยืนยัน',array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
@stop