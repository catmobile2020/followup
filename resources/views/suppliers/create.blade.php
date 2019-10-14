@extends('layouts.master')
@section('title') Create New Supplier @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create New Supplier</div>
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
        {!! Form::open(['route'=>'suppliers.store', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Supplier Name') !!}
                        {!! Form::text('name', null, ['placeholder'=>'Supplier Name....', 'class'=>'form-control']) !!}
                        {!! Form::hidden('user_id',Auth::user()->id) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Supplier E-mail') !!}
                        {!! Form::text('email', null, ['placeholder'=>'Supplier E-mail....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Supplier Phone') !!}
                        {!! Form::text('phone', null, ['placeholder'=>'Supplier Phone....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', 'Supplier Address') !!}
                        {!! Form::text('address', null, ['placeholder'=>'Supplier Address....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Supplier Description') !!}
                        {!! Form::text('description', null, ['placeholder'=>'Supplier Description....', 'class'=>'form-control']) !!}
                    </div>

                {!! Form::submit('ADD Supplier' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });

    </script>

@endsection