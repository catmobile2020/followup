@extends('layouts.master')
@section('title') Create New Department @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create New Department</div>
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
        {!! Form::open(['route'=>'department.store', 'method'=>'POST']) !!}
                    <div class="form-group">
        {!! Form::label('name', 'Department Name') !!}
        {!! Form::text('name', null, ['placeholder'=>'Department Name....', 'class'=>'form-control']) !!}
        {!! Form::hidden('created_by', Auth::user()->id ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Department Description') !!}
                        {!! Form::text('description', null, ['placeholder'=>'Department Description....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('skills', 'Select Work Tools') !!}
                        <select name="skills[]" class="select2 form-control" data-placeholder="Select Work Tools" multiple required>
                            <option value="">Select work tools</option>
                            @foreach($skills as $akill)
                                <option value="{{ $akill->id }}">{{ $akill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                {!! Form::submit('Create Department' , ['class'=>'btn btn-primary']) !!}
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