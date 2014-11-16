@extends('template.managementStructure')
@section('productContent')
<div class = "col-md-8 well">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Order Management</h3>
      </div>
      <div class="panel-body well">
        <div ng-app ="App" >
          <div class = "row">
            <div class="col-md-12">
              <form   class = "col-md-5" action="{{ URL::to('product/search') }}">
                <div class ="form-group">
                  <div class ="input-group">
                    <div class="input-group-addon"><span class = "glyphicon glyphicon-search" ></span></div>
                    <input id = "search" name = "search" type="text" name = "token" class="form-control "
                       placeholder="ใส่คำที่ต้องการ Search" data-list=".list">
                  </div>
                </div>
              </form>
            </div>
          </div>
        <div class="row">
        @foreach($orders as $order)
            <div  class ="col-md-4">
              
              <ul class = "panel list" >
                <a href = "{{ URL::to('order/'.$order->getId().'/delete') }}"><span class = "glyphicon glyphicon-trash btn btn-danger pull-right" ></span></a>
                <li>
                  <div class = "equal">
                    <b>Name :</b> {{ $order->getNamefromId() }}<br/>
                    <b>Total :</b> {{ $order->getTotal_price() }}<br/>
                    <b>OrderTime :</b> {{ $order->getOrder_time() }}<br/>
                    <ul>
                      <div style = "height:70px;overflow:scroll;overflow-x:hidden;">
                        @foreach($order->getProducts() as $product)
                         <li> {{ $product->getProductName() }} </li>
                        @endforeach
                      </div>
                    </ul>
                    <b>Status :</b>
                    @if( $order->getStatus() )
                      <div class="btn-group " role="group" aria-label="...">
                        <button type="button" onclick = "changeToSent({{ $order->getId(); }})" id = "sent_btn{{ $order->getId() }}" class="btn btn-default active">ส่งแล้ว</button>
                        <button type="button" id = "unsent_btn{{ $order->getId() }}"  class="btn btn-default" onclick = "changeToUnSent({{ $order->getId(); }})">ยังไม่ส่ง</button>
                      </div>
                    @else
                      <div class="btn-group " role="group" aria-label="...">
                        <button onclick = "changeToSent({{ $order->getId(); }})" type="button" id = "sent_btn{{ $order->getId() }}"  class="btn btn-default">ส่งแล้ว</button>
                        <button type="button" id = "unsent_btn{{ $order->getId() }}" onclick = "changeToUnSent({{ $order->getId()}})" class="btn btn-default active">ยังไม่ส่ง</button>
                      </div>
                    @endif 
                    <b>EMS :</b>
                    <div class = "row">
                      <div class = "col-md-8">
                        <input type="text" class = "form-control" value=" {{ $order->getEms() }}" id = "ems_text{{ $order->getId(); }}">
                      </div>
                      <button onclick = "updateEms({{ $order->getId(); }},'ems_text{{ $order->getId(); }}')" class = "btn btn-sm col-md-2"><span class = "glyphicon glyphicon-ok"></span></button>
                    </div>
                    <br/>
                  </div>
                </li>
              </ul>
            </div> 
           @endforeach
           </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">

  $(document).ready(function () {
     console.log( "ready!" );

  });

    function changeToSent(id){
      $.ajax({
        url: '/order/'+id+'/status',
        timeout: 3000,
        global: false,
        type: 'POST',
        data: { status : 1},
        success: function() {
          $("#sent_btn"+id).toggleClass("active");
          $("#unsent_btn"+id).toggleClass("active");
        },
        error: function(x, t, m) {
          if(t==="timeout") {
            alert("we have a problem with your internet or our server");
          } else {
              alert(t);
          }
        }
      });
    }

    function changeToUnSent(id) {
      $.ajax({
        url: '/order/'+id+'/status',
        timeout: 3000,
        global: false,
        type: 'POST',
        data: { status : 0},
        success: function() {
          $("#sent_btn"+id).toggleClass("active");
          $("#unsent_btn"+id).toggleClass("active");
        },
        error: function(x, t, m) {
          if(t==="timeout") {
            alert("we have a problem with your internet or our server");
          } else {
            alert(t);
          }
        }
      });
    }

    function updateEms(id,input_ems_id) {
      var str_ems = $('#'+input_ems_id).val();
      console.log('str_ems : '+ str_ems)
      $.ajax({
        url: '/order/'+id+'/update',
        timeout: 3000,
        global: false,
        type: 'POST',
        data: { ems : str_ems},
        success: function() {
          console.log("EMS : "+str_ems);
        },
        error: function(x, t, m) {
          if(t==="timeout") {
            alert("we have a problem with your internet or our server");
          } else {
            alert(t);
          }
        }
     });
   }
</script>

@stop 


