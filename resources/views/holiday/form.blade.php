@extends('layouts.master')
@section('title') Create New Holiday @endsection
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
        {!! Form::model($holiday,['url'=>$form_action['url'], 'method'=>$form_action['method']]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, ['placeholder'=>'Enter Title !', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date', 'Date') !!}
                        {!! Form::date('date', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('desc', 'desc') !!}
                        {!! Form::textarea('desc', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="active">
                            <option value="1" {{$holiday->active ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$holiday->active ? '' : 'selected'}}>DisActive</option>
                        </select>
                    </div>

                {!! Form::submit('Submit!' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection