@extends('template.managementStructure')
@section('productContent')
<div class = "col-md-8 well">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Product Management</h3>
      </div>
      <div class="panel-body well">
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
            </div>
          </div>
        <div class="row">
        @foreach($orders as $order)
            <div  class ="col-md-4">
              
              <ul class = "panel list" >
                <li>
                <div class = "equal">
                    <b>Name :</b> {{ $order->getNamefromId() }}<br/>
                    <b>Total :</b> {{ $order->getTotal_price() }}<br/>
                    <b>OrderTime :</b> {{ $order->getOrder_time() }}<br/>
                    <b>Status :</b> {{ $order->getStatus() }}<br/>
                  <ul>
                    <div style = "height:70px;overflow:scroll;overflow-x:hidden;">
                      @foreach($order->getProducts() as $product)
                       <li> {{ $product->getProductName() }} </li>
                      @endforeach
                    </div>
                  </ul>
                  </div>
                   <span><a href = "{{ URL::to('order/'.$order->getId().'/edit') }}"><span class = "glyphicon glyphicon-edit btn btn-success" ></span></a>
                  <a href = "{{ URL::to('order/'.$order->getId().'/delete') }}"><span class = "glyphicon glyphicon-trash btn btn-danger" ></span></a></span>
                
                </li>
              </ul>
            </div> 
           @endforeach
           </div>
        </div>
      </div>
    </div>
  </div>
@stop 