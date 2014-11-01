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
        <ul class="chat-messages" style = "overflow:scroll;height:500px;" id="chat-log">
        </ul>
        <div class="chat-footer">
            <div class="p-lr-10">
                <input type="text" id="chat-message"
                    class="input-light input-large brad chat-search form-control" placeholder="Your message...">
            </div>
        </div>
    </div>
  </div>
   <!-- REAL TIME CHAT SCRIPT -->
    <script type="text/javascript">
        $(document).ready(function () {
                var user_id = {{ Auth::user()->id }};
                //make sure to update the port number if your ws server is running on a different one.
                window.app = {};
         
                app.BrainSocket = new BrainSocket(
                        new WebSocket('ws://localhost:8080'),
                        new BrainSocketPubSub()
                );

                app.BrainSocket.Event.listen('generic.event',function(msg){
                    console.log(msg);
                    if(msg.client.data.user_id == user_id){
                        $('#chat-log').append('<li><b>{{ Auth::user()->username }}</b><div class="message">'+msg.client.data.message+'</div></li>');
                    }else{
                        var str_test='<li class="right"><b>'+msg.client.data.username+'</b><div class="message">'+msg.client.data.message+'</div></li>';
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
                        $(this).val('');
         
                    }
         
                    return event.keyCode != 13; }
                );
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