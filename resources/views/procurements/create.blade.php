@extends('layouts.master')
@section('title') Create New Procurement @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
    <style>
        .form-control  {
            height: 40px;
        }
        .ui-helper-hidden-accessible{
            display: none;
        }
    </style>
@endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create New Procurement</div>
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
        {!! Form::open(['route'=>'po.store', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('company_name', 'Company Name') !!}
                        {!! Form::text('company_name', null, ['placeholder'=>'Company Name....', 'class'=>'form-control']) !!}
                        {!! Form::hidden('user_id',Auth::user()->id) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('po_number', 'PO Number') !!}
                        {!! Form::text('po_number', null, ['placeholder'=>'PO Number....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('supplier_id', 'Select Supplier') !!}
                        {!! Form::select('supplier_id', $suppliers->pluck('name','id'), null, ['class' => 'form-control', 'data-placeholder'=>'Select Supplier']) !!}

                    </div>
                    <div class="form-group">
                        {!! Form::label('items', 'Items with description') !!}
                        {!! Form::textarea('items', null, ['placeholder'=>'Items with description....', 'class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('deadline', 'Delivery Date') !!}
                            <div id="date-popup" class="input-group date">
                                {!! Form::text('deadline', null, ['data-format'=>'D, dd MM yyyy', 'class'=>'form-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>

                    </div>
                    <div class="form-group">
                        {!! Form::label('place', 'Delivery Place') !!}
                        {!! Form::text('place', null, ['placeholder'=>'Delivery Place....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('details', 'Details') !!}
                        {!! Form::textarea('details', null, ['placeholder'=>' Details....', 'class'=>'form-control']) !!}
                    </div>

                {!! Form::submit('ADD Procurement' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();

            $('#date-popup').datepicker({
                dateFormat: 'dd/mm/y',
                keyboardNavigation: false,
                forceParse: false,
                todayHighlight: true
            });
        });

    </script>

@endsection