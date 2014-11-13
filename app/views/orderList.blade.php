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
              <th>user</th>
              <th>totalPrice</th>
              <th>orderTime</th>
              <th>status</th>
              <th>Product</th>
              <th>edit</th>
              <th>delete</th>
            </tr>
          </thead>
           <tbody class = "list">
            @foreach($orders as $order)
            <tr>
              <td>{{ $order->getNamefromId() }}</td>
              <td>{{ $order->getTotal_price() }}</td>
              <td>{{ $order->getOrder_time() }}</td>
              <td>{{ $order->getStatus() }}</td>
              <td>
                @foreach($order->getProducts() as $product)
                    {{ $product->getProductName() }}
                @endforeach
              </td>
              <td><a href = "{{ URL::to('order/'.$order->getId().'/edit') }}"><span class = "glyphicon glyphicon-edit" ></span></a></td>
              <td><a href = "{{ URL::to('order/'.$order->getId().'/delete') }}"><span class = "glyphicon glyphicon-trash" ></span></a></td>
            </tr>
            @endforeach
           </tbody> 
           </table>
        </div>
      </div>
    </div>
  </div>
@stop 