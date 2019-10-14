@extends('layouts.master')
@section('title') Employee Voting| Create @endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Employee Voting</div>
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
        {!! Form::open(['route'=>'employee-of-the-month.store', 'method'=>'POST']) !!}
                    <div class="form-group">
        {!! Form::label('title', 'Employee Voting Of The Month') !!}
        {!! Form::text('title', null, ['placeholder'=>'Jan 2020, Feb 2020 ', 'class'=>'form-control']) !!}
        {!! Form::hidden('user_id', Auth::user()->id ) !!}
                    </div>

                {!! Form::submit('Create Employee Voting' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection