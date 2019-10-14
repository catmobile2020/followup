@extends('layouts.master')
@section('title')Edit User @endsection
@section('styles')
    <style>
        select {
            padding-top: 0 !important;
        }
    </style>
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
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
                <div class="panel-heading">Edit {{ $user->name }}</div>
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
                    {!! Form::model($user, ['route'=>['user.updateUser', $user->id], 'method'=>'PATCH', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Full Name') !!}
                        {!! Form::text('name', null, ['placeholder'=>'Your FullName Here !!', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Phone') !!}
                        {!! Form::text('phone', null, ['placeholder'=>'01xxxxxxxx', 'class'=>'form-control']) !!}
                    </div>

                        <div class="form-group">
                            {!! Form::label('address', 'Address') !!}
                            {!! Form::text('address', null, ['placeholder'=>'Full Address', 'class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('bio', 'Bio') !!}
                            {!! Form::textarea('bio', null, ['placeholder'=>'Bio', 'class'=>'form-control', 'id'=>'bio']) !!}


                        </div>
                        <div class="form-group">
                            {!! Form::label('role_id', 'Select Role') !!}
                            {!! Form::select('role_id', $roles->pluck('name','id'), $user->role->id, ['class' => 'form-control', 'data-placeholder'=>'Select Role']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('team_id', 'Select Team') !!}
                            {!! Form::select('team_id', $teams->pluck('name','id'), $user->team->id, ['class' => 'form-control', 'data-placeholder'=>'Select Team']) !!}

                        </div>


                    <div class="form-group">
                        {!! Form::label('skills[]', 'Select Group') !!}
                        {!! Form::select('skills[]', $skills->pluck('name','id'), $user->skills, ['class' => 'select2 form-control', 'data-placeholder'=>'Select Group', 'multiple']) !!}

                    </div>

                    {!! Form::submit('Update Account' , ['class'=>'btn btn-primary']) !!}
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
    <script src="{{URL::asset('js/plugins/summernote/summernote.min.js')}}"></script>
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
            $('#bio').summernote({
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
        });

    </script>


@endsection
