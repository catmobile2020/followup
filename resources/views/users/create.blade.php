@extends('layouts.master')
@section('title') Add New User @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
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
                <div class="panel-heading">Create New User</div>
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
                    <form method="POST" action="{{ route('users.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Full Name</label>
                            <input id="name" type="text" placeholder="Full Name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username">User Name</label>
                            <input id="username" type="text" placeholder="User Name" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-mail Address</label>
                            <input id="email" type="email" placeholder='myemail@domain.com' class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Mobile NO:</label>
                            <input id="phone" type="text" placeholder='01xxxxxxxx' value="{{ old('phone') }}" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input id="address" type="text" placeholder='Full Address' value="{{ old('address') }}" class="form-control" name="address" >
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio:</label>
                            <textarea name="bio" class="form-control" id="bio" title="BIO">{{ old('bio') }}</textarea>

                        </div>

                        <div class="form-group">
                            <label for="address">Department:</label>
                            <select class="form-control" name="team_id" id="team">
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Role:</label>
                            <select class="form-control" name="role_id" id="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>
                            <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" placeholder="Re-type Password" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Skills</label>
                                <select name="skills[]" class="select2 form-control" data-placeholder="Select Skill" multiple required>
                                    <option value="">Select Group</option>
                                    @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Create User
                            </button>
                        </div>
                    </form>
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