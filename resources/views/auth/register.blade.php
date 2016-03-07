@extends('layouts.guest')

@section('content')
<div class="col-md-6 col-md-offset-3">
    <div class="login-panel panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">{{ trans('auth.register') }}</h3></div>
        <div class="panel-body">
			@include('auth.partials._errors')
        	{!! Form::open(['route'=>'auth.register','class'=>'form-horizontal']) !!}
            <div class="form-group {!! $errors->has('name') ? 'has-error' : ''; !!}">
            	{!! Form::label('name', trans('app.name'), ['class'=>'col-md-4 control-label']) !!}
				<div class="col-md-6">
					{!! Form::text('name', null, ['class'=>'form-control','placeholder' => trans('app.name')]) !!}
				</div>
            </div>
            <div class="form-group {!! $errors->has('username') ? 'has-error' : ''; !!}">
            	{!! Form::label('username', trans('auth.username'), ['class'=>'col-md-4 control-label']) !!}
				<div class="col-md-6">
					{!! Form::text('username', null, ['class'=>'form-control','placeholder'=>trans('auth.username')]) !!}
				</div>
            </div>
            <div class="form-group {!! $errors->has('email') ? 'has-error' : ''; !!}">
            	{!! Form::label('email', trans('user.email'), ['class'=>'col-md-4 control-label']) !!}
				<div class="col-md-6">
					{!! Form::text('email', null, ['class'=>'form-control','placeholder'=>trans('user.email')]) !!}
				</div>
            </div>
            <div class="form-group {!! $errors->has('password') ? 'has-error' : ''; !!}">
            	{!! Form::label('password', trans('auth.password'), ['class'=>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                	{!! Form::password('password', ['class'=>'form-control','placeholder'=>trans('auth.password')]) !!}
                </div>
            </div>
            <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : ''; !!}">
            	{!! Form::label('password_confirmation', trans('auth.password_confirmation'), ['class'=>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                	{!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>trans('auth.password_confirmation')]) !!}
                </div>
            </div>
            <div class="form-group">
				<div class="col-md-8 col-md-offset-4">
            		{!! Form::submit(trans('auth.register'), ['class'=>'btn btn-info']) !!}
                    {!! link_to_route('auth.login',trans('auth.have_an_account'),[],['class'=>'btn btn-success']) !!}
				</div>
			</div>
            {!! Form::close() !!}
        </div>
    </div>
		@include('layouts.partials.footer')
</div>
@endsection
