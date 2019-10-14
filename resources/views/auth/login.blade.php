<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WE100App - A fully restful API, laravel based admin">
    <title>{{ env('APP_NAME') }} | Login </title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='{{URL::asset('images/favicon.ico')}}' />
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

</head>
<body class="login-page">
<div class="login-container">
    <div class="login-branding">
        <a href="#"><img src="images/logo.png" alt="{{ env('APP_NAME') }}" title="{{ env('APP_NAME') }}"></a>
    </div>
    <div class="alert  alert-dismissible" role="alert"><strong></strong>  </div>
    <div class="login-content">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h2><strong>Welcome</strong>, please login</h2>
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('username') || $errors->has('email') ? ' has-error' : '' }}">

                    <input type="text" class="form-control" name="email" placeholder="E-Mail / Username" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('username') || $errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') . $errors->first('email') }}</strong>
                                    </span>
                    @endif
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
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>


            </div>
            <p class="text-center"><a href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a></p>

        </form>
    </div>
</div>

<!--Load JQuery-->
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
</body>
</html>


