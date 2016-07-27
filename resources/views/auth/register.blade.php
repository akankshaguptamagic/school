@extends('layouts.loginlayout')

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
          <a class="navbar-brand" href="#">SCH<i class="fa fa-circle"></i><i class="fa fa-circle"></i>L PR<i class="fa fa-circle"></i>JECT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url ('/') }}">HOME</a></li>
            <li><a href="{{ url ('/login') }}">LOGIN</a></li>
          </ul>
            
        </div><!--/.nav-collapse -->
      </div>
    </div>
 @if (Session::has('message'))
                <div id="alert_message" class="alert alert-success" align="center" style="margin-top:50px">{{ Session::get('message') }}</div>
         @endif

<div class="container" style="padding-top:40px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'register.store']) !!}
						
                        <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
							
							{!! Form::label('title', 'First Name', ['class' => 'control-label']) !!}
							{!! Form::text('firstname', "$user->firstname", ['class' => 'form-control', 'readonly' => 'true' ]) !!}
							 @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('firstname') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
						
						{!! Form::label('title', 'Lastname', ['class' => 'control-label']) !!}
						{!! Form::text('lastname', "$user->lastname", ['class' => 'form-control', 'readonly' => 'true']) !!}
							@if ($errors->has('lastname'))
								<span class="help-block">
									<strong>{{ $errors->has('lastname')}}</strong>
								</span>
							@endif
					</div>
						<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						
						{!! Form::label('title', 'School', ['class'=>'control-label'])!!}
						
						{!! Form::text('school',"$user->school", ['class' => 'form-control', 'id' =>'school_id','readonly' => 'true']) !!}
						
						@if($errors->has('school'))
							<span class="help-block">
								<strong>{{ $errors->has('school') }}</strong>
							</span>
						@endif
					</div>
					 <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        
                        {!! Form::label('title', 'Child First Name', ['class' => 'control-label']) !!}
                        {!! Form::text('childs_firstname', "$user->childs_firstname", ['class' => 'form-control', 'readonly' => 'true']) !!}
                         @if ($errors->has('childs_firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('childs_firstname') }}</strong>
                                    </span>
                                @endif
                    </div>
                  <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                        
                        {!! Form::label('title', 'Child Last Name', ['class' => 'control-label']) !!}
                        {!! Form::text('childs_lastname', "$user->childs_lastname", ['class' => 'form-control','readonly' => 'true']) !!}
                         @if ($errors->has('childs_lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('childs_lastname') }}</strong>
                                    </span>
                                @endif
                    </div>
                <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						
						{!! Form::label('title', 'Relationship to Child', ['class'=>'control-label'])!!}
						{!! Form::text('relationship_to_child', "$user->relationship_to_child", ['class' => 'form-control','readonly' => 'true']) !!}
						@if($errors->has('school'))
							<span class="help-block">
								<strong>{{ $errors->has('relationship_to_child') }}</strong>
							</span>
						@endif
					</div>
                  <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						
						{!! Form::label('title', 'Classroom', ['class'=>'control-label'])!!}
						{!! Form::text('classroom', $user->classroom, ['class' => 'form-control', 'id' => 'class_id','readonly' => 'true']) !!}
						@if($errors->has('classroom'))
							<span class="help-block">
								<strong>{{ $errors->has('classroom') }}</strong>
							</span>
						@endif
					</div>
				<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
						
						{!! Form::label('title', 'Mobile Number', ['class'=>'control-label'])!!}
						{!! Form::number('mobile_no', "$user->mobile_no", ['class' => 'form-control','readonly' => 'true']) !!}
						@if($errors->has('mobile_no'))
							<span class="help-block">
								<strong>{{ $errors->has('mobile_no') }}</strong>
							</span>
						@endif
					</div>
                        <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
					
					{!! Form::label('title', 'Email', ['class' => 'control-label']) !!}
					{!! Form::email('email', "$user->email", ['class' => 'form-control','readonly' => 'true']) !!}
					 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('email') }}</strong>
                                    </span>
                                @endif
				</div>

                        <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
					
					{!! Form::label('title', 'Password', ['class' => 'control-label']) !!}
					{{ Form::password('password', array( 'class'=>'form-control' ) ) }}
					
					 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('password') }}</strong>
                                    </span>
                                @endif
				</div>

                        <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
					
					{!! Form::label('title', 'Confirm Password', ['class' => 'control-label']) !!}
					{{ Form::password('confirm_password', array( 'class'=>'form-control' ) ) }}
					 @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->has('confirm_password') }}</strong>
                                    </span>
                                @endif
				</div>

                        <div class="form-group">
						{!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}
					</div>
                    {!! Form::close() !!}
                </div>
<script type="text/javascript">
       window.setTimeout(function() {
       $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
       $(this).remove(); 
        });
     }, 3000);
</script>


            </div>
        </div>
    </div>
</div>
 

@endsection
