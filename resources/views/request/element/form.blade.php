@extends('layouts.master')
@section('title') Request Elements @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
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
        {!! Form::model($element,['url'=>$form_action['url'], 'method'=>$form_action['method']]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::textarea('title', null, ['placeholder'=>'Enter Title !', 'class'=>'form-control','id'=>'textarea']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', 'Type') !!}
                        {!! Form::select('type',['text'=>'text','select'=>'selection','checkbox'=>'checkbox'], null, [ 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('value', 'value (when insert multi values used , it ex: val_1,val_2,.....,val_n') !!}
                        {!! Form::text('value', null, ['placeholder'=>'Enter value !', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('placeholder', 'placeholder') !!}
                        {!! Form::text('placeholder', null, ['placeholder'=>'Enter placeholder !', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('validation', 'validation') !!}
                        {!! Form::select('validation',[1=>'required',0=>'not required'],null, [ 'class'=>'form-control']) !!}
                    </div>
                {!! Form::submit('Submit!' , ['class'=>'btn btn-primary']) !!}
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

        $('#textarea').summernote({
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