@extends('template.shopStructure')
@section('shopContent')
	<div class = "row" >
		<div class = "col-md-6">
			<img class = "img-responsive" src = "{{ asset('img/'.$product->getImgPath()) }}" />
		</div>
		<div class ="col-md-6">
			<div class = "panel panel-default">
				<div class= "panel-body">
					<table class = "table  table-striped table-hover" >
					<tr>
						<td>name</td>
						<td>{{ $product->getProductName() }} </td>
					</tr>
					<tr>
						<td>price</td>
						<td>{{ $product->getPrice() }} </td>
					</tr>
					<tr>
						<td>category</td>
						<td>{{ $product->getCategory() }}</td>
					</tr>
					<tr>
						<td>description</td>
						<td>{{ $product->getDescription() }}</td>
					</tr>
					<tr>
						<td>size</td>
						<td>{{ $product->getSize() }}</td>
					</tr>
					<tr>
						<td>color</td>
						<td>{{ $product->getColor() }}</td>
					</tr>
					<tr>
						<td>Suplier</td>
						<td>{{ $product->getSuplier() }}</td>
					</tr>
					<tr>
						<td>Amount</td>
						<td>{{ $product->getAmount() }}</td>
					</tr>
				</table>	
				</div>
			</div>
		<a href="#" class="btn btn-primary" role="button">เพิ่มลงในตะกร้า</a>
		<a href="{{ URL::to('/') }}" class="btn btn-success" role="button">กลับ</a>
		</div> 
	</div>
@stop