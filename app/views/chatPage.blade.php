@extends('template.shopStructure')
@section('shopContent')
  @if(isset($user))
  <div class ="chat panel panel-danger" >
    <div class="chat-header panel-heading">
      <a href="#" id="chat-toggle" class="pull-right chat-toggle">
        <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
      <b style = "color:white" >Chat With other people</b>
  </div>

  <div class="messenger-body open panel-body">
    <div class="panel panel-default">
      <div class="panel-body" style = "text-align:center;">
        <b><h6>ขณะนี้เจ้าของร้านกำลัง <span  class = "admin_status"  ></span></h6></b>
      </div>
    </div>

    <form action = "#">
      <ul class="chat-messages media-list well" style = "overflow:scroll;height:500px;" id="chat-log">
        @foreach ($messages as $message)
          <li class="media">
            <span class="col-md-2" >
              <img src="http://placehold.it/60x60" alt="...">
            </span>
            <div class="col-md-9 panel">
              <b class="media-heading">{{{ $message->name }}}</b>  form {{ $message->created_at }}
              <br/>
              <div>{{{ $message->message }}}</div> 
            </div>
          </li>
        @endforeach
        <hr>
      </ul>

      <div class="chat-footer">
        <div class="p-lr-10">
          <input type="text" id="chat-message"
            class="input-light input-large brad chat-search form-control" placeholder="Your message...">
        </div>
      </div>
    </form>
  </div>
</div>

   <!-- REAL TIME CHAT SCRIPT -->
<script type="text/javascript">
  $(document).ready(function () {
    //SCROLL CHAT TO BOTTOM
    var height_cal = $('ul li').last().position().top + $('ul li').last().height();
    $(".chat-messages").animate({ scrollTop : height_cal }, "slow");
    //POLLING CALL

    get_status();
    var user_id = {{ Auth::user()->id }};
    var msg_tmp;

    //make sure to update the port number if your ws server is running on a different one.
    window.app = {};

    //update AdminStatus
    var user_permission = '{{ Auth::user()->username }}';
    if(user_permission == 'admin'){
      //ajax post to route for update admin status.
      $.post( "/admin/admin/online", {status : 1} , function( data ) {
      });
    }
         
    app.BrainSocket = new BrainSocket(
      new WebSocket('ws://sellon.cloudapp.net:8080'),
      new BrainSocketPubSub()
    );

    app.BrainSocket.Event.listen('generic.event',function(msg){
      console.log(msg);
      $(".chat-messages").animate({ scrollTop : height_cal }, "slow");

      if(msg.client.data.user_id == user_id){
        $('#chat-log').append('<li class="media"><span class="col-md-2" ><img src="http://placehold.it/60x60" alt="..."></span><div class="col-md-9 panel"><b class="media-heading">{{{ Auth::user()->username }}}</b> <br/><div>'+msg.client.data.message+'</div></div>');
      }else{
        var str_test = '<li class="media"><span class="col-md-2" ><img src="http://placehold.it/60x60" alt="..."></span><div class="col-md-9 panel"><b class="media-heading">'+msg.client.data.username+'</b> <br/><div>'+msg.client.data.message+'</div></div>'
        $('#chat-log').append(str_test);
      }
    });
         
    app.BrainSocket.Event.listen('app.success',function(data){
      console.log('An app success message was sent from the ws server!');
      console.log(data);
    });
         
    app.BrainSocket.Event.listen('app.error',function(data){
      console.log('An app error message was sent from the ws server!');
      console.log(data);
    });
         
    $('#chat-message').keypress(function(event) {
                  
      if(event.keyCode == 13){
        // ADD Picture here ..................
        app.BrainSocket.message('generic.event',
          {
            'message':$(this).val(),
            'user_id':user_id,
            'username':'{{ Auth::user()->username}}',
            'user_portrait':'{{ Auth::user()->portrait_small}}'
          }
        );
        // Colect to Database
        $.post( "chat", { name : '{{ Auth::user()->username}}' , message: $(this).val() } , function( data ) {
        });
        $(this).val('');
        $(".chat-messages").animate({ scrollTop : height_cal }, "slow");
      }
         
    return event.keyCode != 13; }
  );
  // POLLING FUNCTION FOR CHECK ADMIN IS ONLINE...
  function get_status(){
    var feedback = $.ajax({
      type: "POST",
      url: "/admin/check",
      async: false
    }).success(function(){
      setTimeout(function(){get_status();}, 1000);
    }).responseText;
    $('span.admin_status').html(feedback);
    if(feedback == "1"){
      $('span.admin_status').html("<span class='label label-success'>ONLINE</span>");
    }else{
      $('span.admin_status').html("<span class='label label-danger'>OFFLINE</span>");
    }
  }
});
// change Page
$(window).unload(function(){
  $.ajax({
    url: '/admin/admin/online/',
    timeout: 3000,
    global: false,
    type: 'POST',
    data: { status : 0},
    async: false, //blocks window close
    success: function() {

    },
    error: function(x, t, m) {
      if(t==="timeout") {
        alert("we have a problem with your internet or our server");
      } else {
        alert(t);
      }
    }
  });
});
</script>
@else
  <div class="alert alert-dismissable alert-warning">
     <button type="button" class="close" data-dismiss="alert">×</button>
     <h4>Warning!</h4>
      <p> กรุณา Login ก่อน หรือสมัครสมาชิกก่อนจะใช้งานระบบ chat นะครับ</p>
  </div>
@endif
@stop
@section('nav/chat')
active
@stop
