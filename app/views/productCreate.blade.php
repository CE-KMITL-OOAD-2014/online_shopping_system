@extends('template.managementStructure')
@section('productContent')
	{{ Form::open(array('url' => 'product' , 'class' => 'form-horizontal','files'=>true )) }}
		<div class="form-group">
			<label for="price" class="col-lg-2 control-label">price</label>
		    <div class="col-lg-10">
		      <input type="number" class="form-control" name = "price" id="price" placeholder="price">
		    </div>
		</div>
		<div class="form-group">
			<label for="category" class="col-lg-2 control-label">category</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" name = "category" id="category" placeholder="category">
		    </div>
		</div>
		<div class="form-group">
			<label for="description" class="col-lg-2 control-label">description</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" name = "description" id="description" placeholder="description">
		    </div>
		</div>
		<div class="form-group">
			<label for="size" class="col-lg-2 control-label">size</label>
		    <div class="col-lg-10">
		      <input type="number" class="form-control" name = "size" id="size" placeholder="size">
		    </div>
		</div>
		<div class="form-group">
			<label for="color" class="col-lg-2 control-label">color</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" id="color" name = "color" placeholder="color">
		    </div>
		</div>
		<div class="form-group">
			<label for="suplier" class="col-lg-2 control-label">suplier</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" name = "suplier" id="suplier" placeholder="suplier">
		    </div>
		</div>
		<div class="form-group">
			<label for="amount" class="col-lg-2 control-label">amount</label>
		    <div class="col-lg-10">
		      <input type="number" class="form-control" name = "amount" id="amount" placeholder="amount">
		    </div>
		</div>

		<div class="form-group">
			<label for="amount" class="col-lg-2 control-label">upload Image</label>
		    <div class="col-lg-10">
		      {{ Form::file('img_file','',array('id'=>'','class'=>'')) }}
		    </div>
		</div>

		{{ Form::submit('ยืนยัน',array('class' => 'btn btn-success')) }}
		<a href = "{{ URL::to('product') }}" class = "btn btn-primary">กลับ</a>
	{{ Form::close() }}
@stop
