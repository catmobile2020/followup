@extends('layouts.master')
@section('title') Create New Skill @endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Add New Skill</div>
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
        {!! Form::open(['route'=>'skill.store', 'method'=>'POST']) !!}
                    <div class="form-group">
        {!! Form::label('name', 'Skill Name') !!}
        {!! Form::text('name', null, ['placeholder'=>'Skill Name....', 'class'=>'form-control']) !!}
        {!! Form::hidden('created_by', Auth::user()->id ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Skill Description') !!}
                        {!! Form::text('description', null, ['placeholder'=>'Skill description....', 'class'=>'form-control']) !!}
                    </div>

                {!! Form::submit('Create Skill' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection