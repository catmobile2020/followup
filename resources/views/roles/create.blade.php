@extends('layouts.master')
@section('title') Create New Role @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create New Role</div>
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
        {!! Form::open(['route'=>'role.store', 'method'=>'POST']) !!}
                    <div class="form-group">
        {!! Form::label('name', 'Role Name') !!}
        {!! Form::text('name', null, ['placeholder'=>'Role Name....', 'class'=>'form-control']) !!}
        {!! Form::hidden('created_by', Auth::user()->id ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Role Description') !!}
                        {!! Form::text('description', null, ['placeholder'=>'Role Description....', 'class'=>'form-control']) !!}
                    </div>
                {!! Form::submit('Create Role' , ['class'=>'btn btn-primary']) !!}
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