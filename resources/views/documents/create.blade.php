@extends('layouts.master')
@section('title') Add New Document @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <style>
        .select {
            height: 39px;
        }
    </style>
@endsection
@section('content')





    <div class="row">
        <div class="col-lg-2">
            <ul class="list-unstyled mail-list">
                <li>
                    <a href="{{ route('document.my', Auth::id()) }}"><i class="fa fa-file"></i> My Documents</a>
                </li>
                <li>
                    <a href="{{ route('document.index') }}"><i class="fa fa-files-o"></i> All Files</a>
                </li>
                <li>
                    <a href="{{ route('document.create') }}"><i class="fa fa-upload"></i>New Document</a>
                </li>
            </ul>

            <h3 class="title text-uppercase m-l-20">Categories</h3>
            <ul class="list-unstyled category-list">
                <li><a href="#"> <i class="fa fa-circle text-purple"></i> HR </a></li>
                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Management</a></li>
                <li><a href="#"> <i class="fa fa-circle text-danger"></i> Announcement</a></li>
                <li><a href="#"> <i class="fa fa-circle text-primary"></i> Social</a></li>
                <li><a href="#"> <i class="fa fa-circle text-info"></i> Other</a></li>
            </ul>

        </div>
        <div class="col-lg-10">

            <div class="mail-box">
                <div class="mail-box-header clearfix">
                    <h3 class="mail-title">Documents Center</h3>
                </div>
                <div class="mail-body">
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
                    {!! Form::open(['route'=>'document.store', 'method'=>'POST', 'files'=> true]) !!}
                    <div class="form-group">
                        {!! Form::label('document', 'Document') !!}
                        {!! Form::file('document', $attributes = ['class'=>'btn btn-black', 'accept'=>'*/*']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title', 'Document Name') !!}
                        {!! Form::text('title', null, ['placeholder'=>'Document Name....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Document Description') !!}
                        {!! Form::text('description', null, ['placeholder'=>'Document Description....', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('category', 'Category') !!}
                        <select name="category" class="select form-control" data-placeholder="Select Category"  required>
                            <option value="">Select Category</option>
                            <option value="1">HR</option>
                            <option value="2">Management</option>
                            <option value="3">Announcement</option>
                            <option value="4">Social</option>
                            <option value="5">Other</option>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit"><i class="fa fa-cloud-upload"></i> Upload Document</button>
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