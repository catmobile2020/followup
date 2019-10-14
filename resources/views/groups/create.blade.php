@extends('layouts.master')
@section('title') Create New Group @endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create New Group</div>
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
        {!! Form::open(['route'=>'group.store', 'method'=>'POST']) !!}
                    <div class="form-group">
        {!! Form::label('name', 'Group Name') !!}
        {!! Form::text('name', null, ['placeholder'=>'Group Name....', 'class'=>'form-control']) !!}
        {!! Form::hidden('created_by', Auth::user()->id ) !!}
                    </div>

                {!! Form::submit('Create Group' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection