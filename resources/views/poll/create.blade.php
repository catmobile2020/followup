@extends('layouts.master')
@section('title') Create New Poll @endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Add New Poll</div>
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
        {!! Form::open(['route'=>'poll.store', 'method'=>'POST']) !!}
                    <div class="form-group">
        {!! Form::label('title', 'Poll Name') !!}
        {!! Form::text('title', null, ['placeholder'=>'Poll Question....', 'class'=>'form-control']) !!}
        {!! Form::hidden('user_id', Auth::user()->id ) !!}
                    </div>

                {!! Form::submit('Create Poll' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection