<?php $title="chat"; ?>
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<div id="ChatBig">
    <div id="ChatMessages" style="overflow:auto;padding-bottom:auto;"></div>
    <br/>



<div class='row'>
        {!! Form::open(['url'=>'/groupchatsend','id'=>'chat' ,'method'=>'POST','class'=>"col-md-12"])!!}
						<div class="col-md-6">
            <div class='form-group'>
              {!! Form::text('text', null, ['class' => 'form-control','id'=>'text'])!!}
						</div>

					<input type="hidden" value="{{Request::segment(2)}}" name="group_id" />

	</div>
	<div class="col-md-2">

	{!! Form::submit('Send',['class'=>'btn btn-success btn-sm form-control'])!!}

	</div>

                    </div>

        {!! Form::close() !!}

@endsection
@section('script')
<script>
var segment={{ Request::segment(2) }};
    $(document).ready(
            function() {
                setInterval(function() {
                    var randomnumber = Math.floor(Math.random() * 100);
									//	console.log('hii');
									$.get('{{url("/groupchatreceive")}}/{{  Request::segment(2) }}', function(data)
									    {
									    if ((data.length > 0) )
										 {
										   $("#ChatMessages").html("");
										   $('#ChatMessages').append('<br><div>'+data+'</div><br>');
										 }
									   });
                }, 300);
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
        url:'{{url('/groupchatsend')}}',
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
