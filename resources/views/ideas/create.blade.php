@extends('layouts.master')
@section('title') Send New Idea @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
@endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create New Idea</div>
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
        {!! Form::open(['route'=>'idea.store', 'method'=>'POST', 'files'=>true]) !!}
                    <div class="form-group">
        {!! Form::label('subject', 'IDEA Subject') !!}
        {!! Form::text('subject', null, ['placeholder'=>'IDEA Subject....', 'class'=>'form-control']) !!}
        {!! Form::hidden('created_by', Auth::user()->id ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'IDEA Description') !!}
                        <textarea name="description" class="form-control" id="description" title="IDEA Description....">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        {!! Form::label('attaches', 'Attachment(s)') !!}
                        {!! Form::file('attaches[]', ['class'=>'form-control', 'multiple'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('managers', 'Select Manager(s)') !!}
                        <select name="managers[]" class="select2 form-control" data-placeholder="Select Manager(s)" multiple required>
                            <option value="">Select work tools</option>
                            @foreach($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>
                {!! Form::submit('Send IDEA' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/summernote/summernote.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });

        $('#description').summernote({
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