@extends('layouts.master')
@section('title')Edit Profile @endsection
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
                    {!! Form::model($user, ['route'=>['users.update', $user->id], 'method'=>'PATCH', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Full Name') !!}
                        {!! Form::text('name', null, ['placeholder'=>'Your FullName Here !!', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Phone') !!}
                        {!! Form::text('phone', null, ['placeholder'=>'01xxxxxxxx', 'class'=>'form-control']) !!}
                    </div>



                    <div class="form-group">
                        {!! Form::label('photo', 'Image') !!}
                        @if($user->photos)
                            @foreach($user->photos as $user)
                            <img src="{{ url($user->path) }}" />
                            @endforeach
                        @endif
                        {!! Form::file('photo', $attributes = ['class'=>'btn btn-black', 'accept'=>'image/*']) !!}
                    </div>

                    {!! Form::submit('Update Account' , ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
