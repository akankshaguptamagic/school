
@extends('layouts.app')
<?php $title="chat";?>
@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<!-- Construct the box with style you want. Here we are using box-danger -->
<!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
<!-- The contextual class should match the box, so we are using direct-chat-danger -->
<div class="row">
	<div class="col-md-10">
<div class="box box-danger direct-chat direct-chat-success">
  <div class="box-header with-border">
    <h3 class="box-title">Chat</h3>
    <div class="box-tools pull-right">
      <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-red">3</span> -->
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <!-- In box-tools add this button if you intend to use the contacts pane -->
      <!-- <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button> -->
      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages" id="ChatMessages">


    <!-- Contacts are loaded here -->
    <div class="direct-chat-contacts">
      <ul class="contacts-list">
        <li>
          <a href="#">
            <img class="contacts-list-img" src="{{asset('img/user4-128x128.jpg')}}" alt="Contact Avatar">
            <div class="contacts-list-info">
              <span class="contacts-list-name">
                Count Dracula
                <small class="contacts-list-date pull-right">2/28/2015</small>
              </span>
              <span class="contacts-list-msg">How have you been?.</span>
            </div><!-- /.contacts-list-info -->
          </a>
        </li><!-- End Contact Item -->

      </ul><!-- /.contatcts-list -->
    </div><!-- /.direct-chat-pane -->
  </div><!-- /.box-body -->
  <div class="box-footer">
			{!! Form::open(['url'=>'/chatsend','id'=>'chat' ,'method'=>'POST'])!!}
    <div class="input-group">

    {!! Form::text('text', null, ['class' => 'form-control','id'=>'text','placeholder'=>'Enter text here'])!!}
			<input type="hidden" value="{{Request::segment(2)}}" name="receiver_id" />
      <span class="input-group-btn">
        <!-- <button type="button" class="btn btn-danger btn-flat">Send</button> -->
					{!! Form::submit('Send',['class'=>'btn btn-danger btn-flat'])!!}
      </span>

    </div>
  </div><!-- /.box-footer-->
</div><!--/.direct-chat -->
</div>
</div>
@endsection
@section('script')
<script>
var segment={{ Request::segment(2) }};
    $(document).ready(
            function() {
                setInterval(function() {
                    var randomnumber = Math.floor(Math.random() * 100);
									$.get('{{url("/chatreceive")}}/{{  Request::segment(2) }}', function(data)
									    {
									    if ((data.length > 0) )
										 {
										   $("#ChatMessages").html("");
											 var str =data;
											 var str=str.substring(0,str.length - 4)
											 var str=str.split("<$$>");

											$.each(str, function (index, value) {

											var all=jQuery.parseJSON(''+value+'');

											if(all.receiver_id== segment ){
												//console.log('hii');
											if(all.side==='RIGHT'){
												$("#ChatMessages").append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+all.sender_name+'</span><span class="direct-chat-timestamp pull-left">'+all.time+'</span></div><img class="direct-chat-img" src="{{asset("img/user4-128x128.jpg")}}" alt="message user image"><div class="direct-chat-text">'+all.msg+'</div></div></div>');
											}
											if(all.side==='LEFT'){
												 $("#ChatMessages").append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+all.sender_name+'</span><span class="direct-chat-timestamp pull-right">'+all.time+'</span></div><img class="direct-chat-img" src="{{asset("img/user2-160x160.jpg")}}" alt="message user image"><div class="direct-chat-text">'+all.msg+'</div></div>');
											}
										}

											});
											 //var all=jQuery.parseJSON( data );
										  //console.log(res);
										 }
									   });
                },500);
            });


</script>
<script>
$(function(){

$('#chat').on('submit',function(e){

		$.ajaxSetup({
			 headers: {
					 'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
			 }
	 });
    e.preventDefault(e);

        $.ajax({

        method:"POST",
        url:'{{url('/chatsend')}}',
        data:$(this).serialize(),
        dataType: 'json',
        success: function(data){
							document.getElementById('text').value = '';
							document.getElementById('text').focus();

        },
        error: function(data){

        }
    })
    });
});


</script>

@endsection
