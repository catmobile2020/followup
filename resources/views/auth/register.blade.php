<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WE100App - A fully restful API, laravel based admin">
    <title>WE 100 App | Register Page</title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='{{URL::asset('images/fav.ico')}}' />
    <!-- /site favicon -->

    <!-- Entypo font stylesheet -->
    <link href="{{URL::asset('css/entypo.css')}}" rel="stylesheet">
    <!-- /entypo font stylesheet -->

    <!-- Font awesome stylesheet -->
    <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- /font awesome stylesheet -->

    <!-- Bootstrap stylesheet min version -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- /bootstrap stylesheet min version -->

    <!-- Mouldifi core stylesheet -->
    <link href="{{URL::asset('css/mouldifi-core.css')}}" rel="stylesheet">
    <!-- /mouldifi core stylesheet -->

    <link href="{{URL::asset('css/mouldifi-forms.css')}}" rel="stylesheet">

    <!-- Bootstrap RTL stylesheet min version -->
{{--<link href="css/bootstrap-rtl.min.css" rel="stylesheet">--}}
<!-- /bootstrap rtl stylesheet min version -->

    <!-- Mouldifi RTL core stylesheet -->
{{--<link href="css/mouldifi-rtl-core.css" rel="stylesheet">--}}
<!-- /mouldifi rtl core stylesheet -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/html5shiv.min.js') }}"></script>
    <script src="{{URL::asset('js/respond.min.js')}}"></script>
    <![endif]-->

    <!--[if lte IE 8]>
    <script src="{{URL::asset('js/plugins/flot/excanvas.min.js')}}"></script>
    <![endif]-->

    <![endif]-->

    <style>
        .login-content .form-control{
            padding: 0;
        }
        body.login-page {
            background-color: #6595F9;
        }
        .white{
            color:#ffffff;
            border: 1px solid #fff;
            padding: 15px 5px;
        }
        .login-branding{
            padding: 0;
        }
    </style>

</head>
<body class="login-page">
<div class="login-container">
    <div class="login-branding">
        <h1 class="white">We 100 App</h1>
        {{--<a href="index.html"><img src="images/logo.png" alt="Mouldifi" title="Mouldifi"></a>--}}
    </div>
    <div class="login-content">
        <h2>Create an account</h2>
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                    <input id="name" type="text" placeholder="Full Name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                    <input id="username" type="text" placeholder="User Name" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input id="email" type="email" placeholder='myemail@merckgroup.com' class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group">
                <input id="height" type="number" placeholder='Height' value="{{ old('height') }}" class="form-control" name="height" required>
            </div>
            <div class="form-group">
                <input id="weight" type="number" placeholder='Weight' value="{{ old('weight') }}" class="form-control" name="weight" required>
            </div>
            <div class="form-group">
                <input id="bmi" type="number" placeholder='BMI' value="{{ old('bmi') }}" class="form-control" name="bmi" required>
            </div>
            <div class="form-group">

                    <select class="form-control" name="gender" id="gender">
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
            </div>
            <div class="form-group">

                <select class="form-control" name="country" id="country">
                    <optgroup label="Gulf Countries">
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="The United Arab Emirates">The United Arab Emirates</option>
                        <option value="Qatar">Qatar</option>
                        <option value="kuwait">kuwait</option>
                        <option value="Jordon">Jordon</option>
                        <option value="Bahrain">Bahrain</option>
                    </optgroup>
                    <optgroup label="Levant Countries">
                        <option value="Lebanon">Lebanon</option>
                        <option value="Iran">Iran</option>
                    </optgroup>
                </select>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <input id="password-confirm" placeholder="Re-type Password" type="password" class="form-control" name="password_confirmation" required>
            </div>


            <div class="form-group">
                    <button type="submit" class="btn btn-blue btn-block">
                        Register
                    </button>
                <p class="text-center">Have an account <a href="login">Sign in</a></p>
            </div>
        </form>

    </div>
</div>

<!--Load JQuery-->
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
