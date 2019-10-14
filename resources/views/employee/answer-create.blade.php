@extends('layouts.master')
@section('title') Assign Users for {{ $survey->title }} @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <style>
        img.avatar {
            width: 20px;
            height: 20px;
        }
    </style>
@endsection
@section('content')





<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Assign New Users for {{ $survey->title }}</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
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
                <ul class="list-group">
                    <h2># of All voters {{ $survey->results()->count() }}</h2>
                    @foreach($survey->answers as $answer)
                        <li class="list-group-item">
                            @if(count(\App\User::find($answer->answer)->photos) > 0) @foreach(\App\User::find($answer->answer)->photos as $photo) @if($photo->path || file_exists($photo->path))<img width="25" height="25" class="img-circle avatar" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @else <img width="44" class="img-circle avatar" src="http://via.placeholder.com/140x100"> @endif
                            &nbsp; {{ \App\User::find($answer->answer)->name }}  <span class="badge badge-bordered">{{ $answer->results()->count() }}</span>
                                <a style="position: absolute;right: 50%;top: 10%;">{!! Form::open(['route'=>['answer.delete', $answer], 'method'=>'DELETE']) !!}
                                <button type="submit" class="btn btn-danger"><span class="fa fa-trash-o"></span> </button>
                                {!! Form::close() !!} </a>
                            </li>
                    @endforeach
                </ul>

        {!! Form::open(['route'=>'answer.storeUsers', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('users', 'Users') !!}
                        <select name="users[]" class="select2 form-control" data-placeholder="Select users" multiple required>
                            <option value="">Select Users</option>
                            @foreach($users as $user)
                                @if(!in_array($user->id, $survey->answers->pluck('answer')->toArray()) )
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        {!! Form::hidden('survey_id', $survey->id ) !!}
                    </div>

                    {!! Form::submit('Assign User' , ['class'=>'btn btn-primary']) !!}
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