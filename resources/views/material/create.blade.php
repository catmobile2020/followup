@extends('layouts.master')
@section('title') Add New Material @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">

@endsection
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
        {!! Form::open(['route'=>'material.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
        {!! Form::label('name', 'Material Name') !!}
        {!! Form::text('name', null, ['placeholder'=>'Enter Material Name ', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Material Description') !!}
                        {!! Form::text('description', null, ['placeholder'=>'Enter Material Description ', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <div id="date-popup" class="input-group date">
                        {!! Form::label('expiration', 'Expiration Date') !!}
                        {!! Form::text('expiration', null, ['placeholder'=>'Expiration Date', 'id'=>'year-view', 'class'=>'form-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('current_quantity', 'Quantity') !!}
                        {!! Form::text('current_quantity', null, ['placeholder'=>'Quantity', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('image', 'Image') !!}
                        {!! Form::file('image', $attributes = ['class'=>'btn btn-default', 'accept'=>'image/*']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('groups', 'Select Group') !!}
                        <select name="groups[]" class="select2 form-control" data-placeholder="Select Group" multiple required>
                            <option value="">Select Group</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

                {!! Form::submit('Add Material' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#date-popup').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                todayHighlight: false,
                format: "yyyy-mm-dd",
                startDate: '+7d',
            });


            $(".select2").select2();
        });

    </script>

@endsection