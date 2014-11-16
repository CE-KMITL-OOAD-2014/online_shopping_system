@extends('template.structure')
@section('content')
  <div class = "col-md-4">
    <div class="list-group panel" >
      <a class = "list-group-item @yield('nav/home') animsition-link" href = "{{ URL::to('/'); }}" >Home</a>
      <a class = "list-group-item @yield('nav/order') animsition-link" href = "{{ URL::to('shop/order'); }}">Check Order</a>
      <a class = "list-group-item @yield('nav/contact') animsition-link" href = "{{ URL::to('shop/contactUs'); }}">Contact Us</a>
      <a class = "list-group-item @yield('nav/chat') animsition-link" href = "{{ URL::to('shop/chat'); }}">Chat with other people</a>
    </div>
  </div>	
  <div class = "col-md-8 ">
    <div class="alert alert-dismissable alert-warning">
     <button type="button" class="close" data-dismiss="alert">×</button>
     <h4>คำเตือน !</h4>
     <p> คุณไม่มีสิทธิ์เข้าถึงข้อมูลส่วนนี้</p>
  </div>
</div>
@stop
