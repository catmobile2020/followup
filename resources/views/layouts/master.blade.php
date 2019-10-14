
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('pageDescription')">
    <meta name="keywords" content="@yield('Keywords')">
    <title>
        @yield('title') - {{ env('APP_NAME') }}
    </title>
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

    @yield('styles')
</head>
<body>

<!-- Page container -->
<div class="page-container">

    <!-- Page Sidebar -->
    @include('layouts.sidebar')
    <!-- /page sidebar -->

    <!-- Main container -->
    <div class="main-container">

        <!-- Main header -->
        <div class="main-header row">
            <div class="col-sm-6 col-xs-7">

                <!-- User info -->
                <ul class="user-info pull-left">
                    <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">@if(count(Auth::user()->photos) > 0) @foreach(Auth::user()->photos as $photo) @if($photo->path || file_exists($photo->path))<img width="44" class="img-circle avatar" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @else <img width="44" class="img-circle avatar" src="http://via.placeholder.com/140x100"> @endif
                             {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="#"><i class="icon-user"></i>My profile</a></li>
                            <li><a href="#"><i class="icon-mail"></i>Messages</a></li>
                            <li><a href="#"><i class="icon-clipboard"></i>Tasks</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('account.index') }}"><i class="icon-cog"></i><span class="title">Account Setting</span></a></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="icon-logout"></i>
                                    <span class="title">Log out</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form></li>
                        </ul>
                       

                    </li>
                </ul>
                <!-- /user info -->

            </div>

            <div class="col-sm-6 col-xs-5">
                <div class="pull-right">
                    <!-- User alerts -->
                    <ul class="user-info pull-left">

                        <!-- Notifications -->
                        {{--<li class="notifications dropdown">--}}
                            {{--<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-attention"></i><span class="badge badge-danger">{{ session('total') }}</span></a>--}}
                           {{----}}
                        {{--</li>--}}
                        <!-- /notifications -->



                    </ul>
                    <!-- /user alerts -->

                </div>
            </div>
        </div>
        <!-- /main header -->

        <!-- Main content -->
        <div class="main-content">
            @yield('content')
            <!-- Footer -->
            <footer class="footer-main">
                &copy; 2019 <strong> {{ env('APP_NAME') }}</strong>  App by <a target="_blank" href="#">CAT SW</a>
            </footer>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /main container -->

</div>
<!-- /page container -->

<!--Load JQuery-->
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/plugins/metismenu/jquery.metisMenu.js')}}"></script>
<script src="{{URL::asset('js/plugins/blockui-master/jquery-ui.js')}}"></script>
<script src="{{URL::asset('js/plugins/blockui-master/jquery.blockUI.js')}}"></script>

@yield('scripts')
<script src="{{URL::asset('js/functions.js')}}"></script>
</body>
</html>
