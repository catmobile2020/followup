@extends('layouts.master')
@section('title') Request Form @endsection
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
        {!! Form::model($form,['url'=>$form_action['url'], 'method'=>$form_action['method']]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::textarea('title', null, ['placeholder'=>'Enter Title !', 'class'=>'form-control','id'=>'textarea']) !!}
                    </div>
                    @if (Auth::user()->team->name == 'IT')
                        <div class="form-group">
                            <label>Select Department</label>
                            <select name="team_id" class="form-control">
                                <option value selected disabled>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
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