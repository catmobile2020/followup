@extends('layouts.master')
@section('title') Add New Quantity | {{ $material->name }} @endsection
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
                    @if(file_exists($material->image))
                        <div class="row">
                            <img src=" {{url($material->image)}}" class="img-thumbnail col-md-6 col-md-offset-3 img-sm"><br>
                        </div>
                    @endif
        {!! Form::open(['route'=>['quantity.store', $material->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                    {!! Form::label('name', 'Material Name') !!}
                    {!! Form::text('name', $material->name, ['placeholder'=>'Enter Material Name ', 'class'=>'form-control', 'disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Expiration Date') !!}
                        {!! Form::text('name', $material->expiration_date, ['placeholder'=>'Enter Material Name ', 'class'=>'form-control', 'disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('current_quantity', 'Current Quantity') !!}
                        {!! Form::text('current_quantity', $material->current_quantity, ['placeholder'=>'Quantity', 'class'=>'form-control', 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('new_quantity', 'New Quantity') !!}
                        {!! Form::text('new_quantity', null, ['placeholder'=>'Quantity', 'class'=>'form-control']) !!}
                    </div>



                {!! Form::submit('Add new Quantity' , ['class'=>'btn btn-primary']) !!}
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