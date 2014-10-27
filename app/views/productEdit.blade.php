@extends('template.managementStructure')
@section('productContent')
	<img src = "{{ asset('img/'.$product->getImgPath()) }}" />
	{{ Form::open(array('url' => 'product/'.$id.'/edit' , 'class' => 'form-horizontal' )) }}
		<div class="form-group">
			<label for="product_name" class="col-lg-2 control-label">product name</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" name = "product_name" id="product_name" value="{{ $product->getProductName() }}">
		    </div>
		</div>
		<div class="form-group">
			<label for="price" class="col-lg-2 control-label">price</label>
		    <div class="col-lg-10">
		      <input type="number" class="form-control" name = "price" id="price" value="{{ $product->getPrice() }}">
		    </div>
		</div>
		<div class="form-group">
			<label for="category" class="col-lg-2 control-label">category</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" name = "category" id="category" value="{{ $product->getCategory() }}">
		    </div>
		</div>
		<div class="form-group">
			<label for="description" class="col-lg-2 control-label">description</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" name = "description" id="description" value="{{ $product->getDescription() }}">
		    </div>
		</div>
		<div class="form-group">
			<label for="size" class="col-lg-2 control-label">size</label>
		    <div class="col-lg-10">
		      <input type="number" class="form-control" name = "size" id="size" value="{{ $product->getSize() }}">
		    </div>
		</div>
		<div class="form-group">
			<label for="color" class="col-lg-2 control-label">color</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" id="color" name = "color" value="{{ $product->getColor() }}">
		    </div>
		</div>
		<div class="form-group">
			<label for="suplier" class="col-lg-2 control-label">suplier</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" name = "suplier" id="suplier" value="{{ $product->getSuplier() }}">
		    </div>
		</div>
		<div class="form-group">
			<label for="amount" class="col-lg-2 control-label">amount</label>
		    <div class="col-lg-10">
		      <input type="number" class="form-control" name = "amount" id="amount" value="{{ $product->getAmount() }}">
		    </div>
		</div>

		{{ Form::submit('แก้ไข',array('class' => 'btn btn-success')) }}
		<a href = "{{ URL::to('product') }}" class = "btn btn-primary">กลับ</a>
	{{ Form::close() }}
@stop
