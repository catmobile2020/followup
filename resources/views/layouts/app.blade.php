<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Clinic - A fully responsive, laravel based admin theme">
    <meta name="keywords" content="{{ config('keywords', 'doctor') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='{{ URL::asset('images/favicon.ico') }}' />
    <!-- /site favicon -->

    <!-- Entypo font stylesheet -->
    <link href="{{ URL::asset('css/entypo.css') }}" rel="stylesheet">
    <!-- /entypo font stylesheet -->

    <!-- Font awesome stylesheet -->
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- /font awesome stylesheet -->

    <!-- Bootstrap stylesheet min version -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- /bootstrap stylesheet min version -->

    <!-- Mouldifi core stylesheet -->
    <link href="{{ URL::asset('css/mouldifi-core.css') }}" rel="stylesheet">
    <!-- /mouldifi core stylesheet -->

    <link href="{{ URL::asset('css/mouldifi-forms.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/plugins/select2/select2.css') }}" rel="stylesheet">

{{--<!-- Bootstrap RTL stylesheet min version -->--}}
    {{--<link href="{{ URL::asset('css/bootstrap-rtl.min.css') }}" rel="stylesheet">--}}
    {{--<!-- /bootstrap rtl stylesheet min version -->--}}

    {{--<!-- Mouldifi RTL core stylesheet -->--}}
    {{--<link href="css/mouldifi-rtl-core.css" rel="stylesheet">--}}
    {{--<!-- /mouldifi rtl core stylesheet -->--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/html5shiv.min.js') }}"></script>
    <script src="{{ URL::asset('js/respond.min.js') }}"></script>
    <![endif]-->


</head>
<body class="login-page">
<div class="login-container">
    <div class="login-branding">
        <a href="#"><img src="{{ URL::asset('images/logo.png') }}" alt="CATDigital" title="CATDigital"></a>
    </div>
    @yield('content')

</div>
<!--Load JQuery-->
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();
    });
</script>
<script src="{{ URL::asset('js/functions.js') }}"></script>
</body>
</html>


