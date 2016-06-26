@extends('layouts.guest')

@section('title', trans('auth.reset_password'))

@section('content')
<div class="col-md-6 col-md-offset-3">
    <div class="login-panel panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Reset Password</h3></div>
        {!! Form::open(['route'=>'auth.post-reset']) !!}
        <div class="panel-body">
            @include('auth.partials._notifications')
            <p>Silakan melakukan reset password dengan mengisi form berikut :</p>
            {!! FormField::email('email') !!}
            {!! FormField::password('password', ['label' => trans('auth.new_password')]) !!}
            {!! FormField::password('password_confirmation', ['label' => trans('auth.new_password_confirmation')]) !!}
            {!! Form::hidden('token', $token) !!}
        </div>
        <div class="panel-footer">
            {!! Form::submit(trans('auth.reset_password'), ['class'=>'btn btn-info']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
