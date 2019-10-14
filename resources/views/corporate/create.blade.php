@extends('layouts.master')
@section('title') Corporate @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <style>
        .ui-helper-hidden-accessible{
            display: none;
        }
    </style>
@endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Corporate</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }} Updated Successfully
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
        {!! Form::open(['route'=>'corporate.store', 'method'=>'POST']) !!}

                    <div class="form-group">
                        {!! Form::label('about', 'About') !!}
                        <textarea name="about" class="form-control description" title="About Corporate....">@if(!empty(old('about'))) {{ old('about') }} @else {{ $corporate->about }} @endif</textarea>
                    </div>
                    <div class="form-group">
                        {!! Form::label('mission', 'Mission') !!}
                        <textarea name="mission" class="form-control description" title="Corporate Mission....">@if(!empty(old('mission'))) {{ old('mission') }} @else {{ $corporate->mission }} @endif</textarea>
                    </div>
                    <div class="form-group">
                        {!! Form::label('vision', 'Vision') !!}
                        <textarea name="vision" class="form-control description" title="Corporate Vision....">@if(!empty(old('vision'))) {{ old('vision') }} @else {{ $corporate->vision }} @endif</textarea>
                   </div>

                {!! Form::submit('Save' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
    <script src="{{URL::asset('js/plugins/summernote/summernote.min.js')}}"></script>
    <script>
        $('.description').summernote({
            height: 260,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                  // set focus to editable area after initializing summernote
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
        });

    </script>
@endsection