<?php $title="Request To Join"; ?>
@extends('layouts.loginlayout')

@section('contentheader_title')
	Request To Join
@endsection

@section('content')


    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url ('/') }}">SCH<i class="fa fa-circle"></i><i class="fa fa-circle"></i>L PR<i class="fa fa-circle"></i>JECT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url ('/') }}">HOME</a></li>
            <li><a href="{{ url ('/login') }}">LOGIN</a></li>
            <li class="active"><a href="{{ url ('/joinrequest') }}">REQUEST TO JOIN</a></li>
          </ul>    
        </div><!--/.nav-collapse -->
      </div>
    </div>
<br><br>
         

         @if (Session::has('message'))
                <div id="alert_message" class="alert alert-success">{{ Session::get('message') }}</div>
         @endif
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Request To Join!</div>
                <div class="panel-body">
				{!! Form::open(['route' => 'joinrequest.store'])!!}
				<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
					<span class="star">*</span>
					{!! Form::label('title', 'Email', ['class' => 'control-label']) !!}
					{!! Form::email('email', '', ['class' => 'form-control']) !!}
					 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('email') }}</strong>
                                    </span>
                                @endif
				</div>
				<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        <span class="star">*</span>
                        {!! Form::label('title', 'Firstname', ['class' => 'control-label']) !!}
                        {!! Form::text('firstname', '', ['class' => 'form-control']) !!}
                         @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('firstname') }}</strong>
                                    </span>
                                @endif
                    </div>
					<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
						<span class="star">*</span>
						{!! Form::label('title', 'Lastname', ['class' => 'control-label']) !!}
						{!! Form::text('lastname', '', ['class' => 'form-control']) !!}
							@if ($errors->has('lastname'))
								<span class="help-block">
									<strong>{{ $errors->has('lastname')}}</strong>
								</span>
							@endif
					</div>
					<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						<span style="star">*</span>
						{!! Form::label('title', 'School', ['class'=>'control-label'])!!}
						
						{!! Form::select('school', $schools,'null', ['class' => 'form-control', 'placeholder' => 'Please Select','id' =>'school_id']) !!}
						
						@if($errors->has('school'))
							<span class="help-block">
								<strong>{{ $errors->has('school') }}</strong>
							</span>
						@endif
					</div>	
					<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        <span class="star">*</span>
                        {!! Form::label('title', 'Child First Name', ['class' => 'control-label']) !!}
                        {!! Form::text('childs_firstname', '', ['class' => 'form-control']) !!}
                         @if ($errors->has('childs_firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('childs_firstname') }}</strong>
                                    </span>
                                @endif
                    </div>
					<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        <span class="star">*</span>
                        {!! Form::label('title', 'Child Last Name', ['class' => 'control-label']) !!}
                        {!! Form::text('childs_lastname', '', ['class' => 'form-control']) !!}
                         @if ($errors->has('childs_lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('childs_lastname') }}</strong>
                                    </span>
                                @endif
                    </div>
					<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						<span style="star">*</span>
						{!! Form::label('title', 'Relationship to Child', ['class'=>'control-label'])!!}
						{!! Form::select('relationship_to_child', array('Father' => 'Father', 'Mother' => 'Mother', 'Uncle' => 'Uncle', 'Aunt' => 'Aunt'), null, ['class' => 'form-control', 'placeholder' => 'Please Select']) !!}
						@if($errors->has('school'))
							<span class="help-block">
								<strong>{{ $errors->has('relationship_to_child') }}</strong>
							</span>
						@endif
					</div>	
    				<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						<span style="star">*</span>
						{!! Form::label('title', 'Classroom', ['class'=>'control-label'])!!}
						{!! Form::select('classroom', array(''=>'Please select'),null, ['class' => 'form-control', 'id' => 'class_id']) !!}
						@if($errors->has('classroom'))
							<span class="help-block">
								<strong>{{ $errors->has('classroom') }}</strong>
							</span>
						@endif
					</div>	
               		<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						<span style="star">*</span>
						{!! Form::label('title', 'Mobile Number', ['class'=>'control-label'])!!}
						{!! Form::number('mobile_no', null, ['class' => 'form-control']) !!}
						@if($errors->has('mobile_no'))
							<span class="help-block">
								<strong>{{ $errors->has('mobile_no') }}</strong>
							</span>
						@endif
					</div>	
                  	<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        <span class="star">*</span>
                        {!! Form::label('title', 'Note', ['class' => 'control-label']) !!}
                        {!! Form::textarea('note', '', ['class' => 'form-control']) !!}
                         @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('note') }}</strong>
                                    </span>
                                @endif
                    </div>
               		<div class="form-group">
						{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
					</div>
  {!! Form::close() !!}
                  </div>
             
<style type="text/css">
  .alert {
     width:750px; 
     margin-left: 300px;   
   }
 
</style>

<script type="text/javascript">
   window.setTimeout(function() {
   $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
   $(this).remove(); 
   });
  }, 3000);
</script>

<script>
    $('#school_id').on('change', function(e){
		var cat_id = e.target.value;
		//ajax
		$.get('dropdown?cat+id=' + cat_id, function(data){
	    //success data
		$('#class_id').empty();
		$('#class_id').append('<option value="">Please select</option>');
		$.each(data, function(index, subcatObj){
		$('#class_id').append('<option value"'+subcatObj.id+'">'+ subcatObj.room_no + '</option');
		});
	});
});
</script>

<script type="text/javascript">
$('#mobile').on('keypress',function(e){
        var deleteCode = 8;  var backspaceCode = 46;
        var key = e.which;
        if ((key>=48 && key<=57) || key === deleteCode || key === backspaceCode || (key>=37 &&  key<=40) || key===0)    
        {    
            character = String.fromCharCode(key);
            if( character != '.' && character != '%' && character != '&' && character != '(' && character != '\'' ) 
            { 
                return true; 
            }
            else {
               return false; }
         }
         else   { 
            alert('Please Input Numbers Only');

          return false; }
    });
</script>
                </div>
                </div>
                </div>
                </div>
@endsection