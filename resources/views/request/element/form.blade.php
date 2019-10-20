@extends('layouts.master')
@section('title') Request Elements @endsection
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
        {!! Form::model($element,['url'=>$form_action['url'], 'method'=>$form_action['method']]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, ['placeholder'=>'Enter Title !', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', 'Type') !!}
                        {!! Form::select('type',['text'=>'text','select'=>'selection','checkbox'=>'checkbox'], null, [ 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('value', 'value (when insert multi values used , it ex: val_1,val_2,.....,val_n') !!}
                        {!! Form::text('value', null, ['placeholder'=>'Enter value !', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('placeholder', 'placeholder') !!}
                        {!! Form::text('placeholder', null, ['placeholder'=>'Enter placeholder !', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('validation', 'validation') !!}
                        {!! Form::select('validation',[1=>'required',0=>'not required'],null, [ 'class'=>'form-control']) !!}
                    </div>
                {!! Form::submit('Submit!' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection