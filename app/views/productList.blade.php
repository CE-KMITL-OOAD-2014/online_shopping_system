@extends('template.managementStructure')
@section('productContent')
  <div class = "pull-right">
    <a href = "{{ URL::to('product/create') }}" class = "btn btn-success"><span class="glyphicon glyphicon-plus"></span> ADD </a>
  </div>
	<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>price</th>
      <th>category</th>
      <th>description</th>
      <th>size</th>
      <th>color</th>
      <th>suplier</th>
      <th>amount</th>
      <th>edit</th>
      <th>delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
    <tr>
      <td>{{ $product->price }}</td>
      <td>{{ $product->category }}</td>
      <td>{{ $product->description }}</td>
      <td>{{ $product->size }}</td>
      <td>{{ $product->color }}</td>
      <td>{{ $product->suplier }}</td>
      <td>{{ $product->amount }}</td>
      <td><a href = "{{ URL::to('product/'.$product->id.'/edit') }}"><span class = "glyphicon glyphicon-edit" ></span></a></td>
      <td><a href = "{{ URL::to('product/'.$product->id.'/delete') }}"><span class = "glyphicon glyphicon-trash" ></span></a></td>
    </tr>
    @endforeach
   </tbody>
   </table>
@stop 