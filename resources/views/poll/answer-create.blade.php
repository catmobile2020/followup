@extends('layouts.master')
@section('title') Create Answers for {{ $survey->title }} @endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Add New Answers for {{ $survey->title }}</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
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
                <ul class="list-group">
                    <h2># of All voters {{ $survey->results()->count() }}</h2>
                    @foreach($survey->answers as $answer)
                        <li class="list-group-item"> {{ $answer->answer }}  <span class="badge badge-bordered">{{ $answer->results()->count() }}</span>
                                <a style="position: absolute;right: 50%;top: 10%;">{!! Form::open(['route'=>['answer.delete', $answer], 'method'=>'DELETE']) !!}
                                <button type="submit" class="btn btn-danger"><span class="fa fa-trash-o"></span> </button>
                                {!! Form::close() !!} </a>
                            </li>
                    @endforeach
                </ul>

        {!! Form::open(['route'=>'answer.store', 'method'=>'POST']) !!}
                    <div class="form-group">
        {!! Form::label('answer', 'Poll Answer') !!}
        {!! Form::text('answer', null, ['placeholder'=>'Answer....', 'class'=>'form-control']) !!}
        {!! Form::hidden('survey_id', $survey->id ) !!}
                    </div>

                {!! Form::submit('Add Answer' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection