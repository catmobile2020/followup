@extends('layouts.master')
@section('title') Edit {{ $country->name }} @endsection
@section('styles')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            margin-left: 30px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .mt-20{
            margin-top:20px;
        }
    </style>
@endsection
@section('content')





    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $country->name }}</div>

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
                    {!! Form::model($country, ['route'=>['country.update', $country->id], 'method'=>'PATCH', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Country Name') !!}
                        {!! Form::text('name', null, ['placeholder'=>'Your Country Here !!', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mt-20">

                        {!! Form::label('Active', 'Country Status') !!}
                        <label class="switch">
                            {!! Form::checkbox('active', null, $country->active) !!}
                            <span class="slider round"></span>
                        </label>
                        <span class="help-block m-b-none">@if($country->active == 0) This item is deactivated @else This item is activated @endif</span>


                    </div>


                    {!! Form::submit('Update Country!!' , ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')


@endsection