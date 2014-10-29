@extends('template.shopStructure')
@section('shopContent')
		<img src = "{{ asset('img/'.$product->getImgPath()) }}" />
		<div class ="col-md-8">
			{{ $product->getProductName() }} <br>
		<a href="#" class="btn btn-primary" role="button">เพิ่มลงในตะกร้า</a>
		</div>
@stop