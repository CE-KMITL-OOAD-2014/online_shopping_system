@extends('template.managementStructure')
@section('productContent')
<div class = "col-md-8 well">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Product Management</h3>
      </div>
      <div class="panel-body">
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
              <th>name</th>
              <th>price</th>
              <th>category</th>
              <th>description</th>
              <th>size</th>
              <th>color</th>
              <th>suplier</th>
              <th>amount</th>
              <th>edit</th>
              <th>delete</th>
              <th>Promotion</th>
            </tr>
          </thead>
           <tbody class = "list">
            @foreach($products as $product)
            <tr>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->category }}</td>
              <td>{{ substr($product->description, 0,8) }}...</td>
              <td>{{ $product->size }}</td>
              <td>{{ $product->color }}</td>
              <td>{{ substr($product->suplier, 0,6)  }}..</td>
              <td>{{ $product->amount }}</td>
              <td><a href = "{{ URL::to('product/'.$product->id.'/edit') }}"><span class = "glyphicon glyphicon-edit" ></span></a></td>
              <td><a href = "{{ URL::to('product/'.$product->id.'/delete') }}"><span class = "glyphicon glyphicon-trash" ></span></a></td>
              <td><a  href = "{{ URL::to('product/'.$product->id.'/promotion') }}" class = "btn btn-warning btn-xs"><span class="glyphicon glyphicon-plus"></span></a> </td>
            </tr>
            @endforeach
           </tbody> 
           </table>
        </div>
      </div>
    </div>
  </div>
@stop 