@extends('layouts.master')
@section('title') Create New Country @endsection

@section('content')





    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Country</div>

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
                    {!! Form::open(['route'=>'country.store', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Country Name') !!}
                        {!! Form::text('name', null, ['placeholder'=>'Your title Here !!', 'class'=>'form-control']) !!}
                    </div>

                    {!! Form::submit('Add Country!!' , ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
