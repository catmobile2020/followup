@extends('layouts.master')
@section('title')change Password @endsection
@section('styles')
    <style>
        select {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')





    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Errors !</strong><br>
                            @foreach($errors->all() as $error)
                                {{ $error }} <br/>
                            @endforeach
                        </div>
                    @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                    {!! Form::model($user, ['route'=>['users.updatePassword', $user->id], 'method'=>'PATCH', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::label('oldPassword', 'Password') !!}
                        {!! Form::password('oldPassword',  ['placeholder'=>'Old Password', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('newPassword', 'New Password') !!}
                        {!! Form::password('newPassword',  ['placeholder'=>'New Password', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('newPassword_confirmation', 'Confirm') !!}
                        {!! Form::password('newPassword_confirmation',  ['placeholder'=>'confirm password', 'class'=>'form-control']) !!}
                    </div>


                    {!! Form::submit('Update Password!!' , ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
