@extends('layouts.master')
@section('title') Create New Mission @endsection
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
        {!! Form::model($mission,['url'=>$form_action['url'], 'method'=>$form_action['method']]) !!}
                    <div class="form-group">
                        {!! Form::label('reason', 'Reason') !!}
                        {!! Form::text('reason', null, ['placeholder'=>'Enter Reason !', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date from', 'Date') !!}
                        {!! Form::date('date_from', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date to', 'Date') !!}
                        {!! Form::date('date_to', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="type">
                            <option value="morning" {{$mission->type == 'morning' ? 'selected' : ''}}>morning</option>
                            <option value="evening" {{$mission->type == 'evening' ? 'selected' : ''}}>evening</option>
                            <option value="all_day" {{$mission->type == 'all_day' ? 'selected' : ''}}>all day</option>
                        </select>
                    </div>

                {!! Form::submit('Submit!' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection