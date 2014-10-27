@extends('template.managementStructure')
@section('productContent')
<div ng-app ="App" >
  <div class = "row">
    <div class="col-md-12">
        <form   class = "col-md-5" action="{{ URL::to('product/search') }}">
          <div class ="form-group">
            <div class ="input-group">
              <div class="input-group-addon"><span class = "glyphicon glyphicon-search" ></span></div>
              <input id = "search" name = "search" type="text" name = "token" class="form-control " placeholder="ใส่คำที่ต้องการ Search" data-list=".list">
            </div>
          </div>
        </form>
        <span class = "col-md-7" >
          <a  href = "{{ URL::to('product/create') }}" class = "pull-right btn btn-success"><span class="glyphicon glyphicon-plus"></span> ADD </a>  
        </span>
    </div>
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
   <tbody class = "list">
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
</div>
@stop 