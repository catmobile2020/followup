<div class="page-sidebar">

    <!-- Site header  -->
    <header class="site-header">
        <div class="site-logo"><a href="{{ route('home') }}">
                <img src="{{URL::asset('images/logo_light.png')}}" alt="{{ env('APP_NAME') }}" title="{{ env('APP_NAME') }}">
                {{--<h1>{{ env('APP_NAME') }}</h1>--}}
            </a></div>
        <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
        <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
    </header>
    <!-- /site header -->

    <!-- Main navigation -->
    <ul id="side-nav" class="main-menu navbar-collapse collapse">
        {{--<li class="has-sub  "><a href="index.html"><i class="icon-gauge"></i><span class="title">Dashboard</span></a>--}}
            {{--<ul class="nav">--}}
                {{--<li><a href="index.html"><span class="title">Misc.</span></a></li>--}}
                {{--<li><a href="ecommerce-dashboard.html"><span class="title">E-Commerce</span></a></li>--}}
                {{--<li><a href="news-dashboard.html"><span class="title">News Portal</span></a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        @if(Auth::user()->role->name == 'Admin' && Auth::user()->team->name == 'Management')
        <li><a href="{{ route('home') }}"><i class=" icon-home"></i><span class="title">Homepage</span></a>
        </li>
            <li class="has-sub"><a href="#"><i class="icon-map"></i><span class="title">Countries</span></a>
                <ul class="nav collapse">
                    <li><a href="{{ route('country.create') }}"><span class="title">Add New Country</span></a></li>
                    <li><a href="{{ route('country.index') }}"><span class="title">View All Countries</span></a></li>
                </ul>
            </li>
        <li><a href="{{ route('corporate.index') }}"><i class="icon-briefcase"></i><span class="title">Corporate</span></a></li>
            <li class="has-sub"><a href="#"><i class="icon-lock-open"></i><span class="title">Roles</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('role.create') }}"><span class="title">Add New Role</span></a></li>
                <li><a href="{{ route('role.index') }}"><span class="title">View All Roles</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-vcard"></i><span class="title">Departments</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('department.create') }}"><span class="title">Add New Department</span></a></li>
                <li><a href="{{ route('department.index') }}"><span class="title">View All Departments</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-docs"></i><span class="title">Skills</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('skill.create') }}"><span class="title">Add New Skill</span></a></li>
                <li><a href="{{ route('skill.index') }}"><span class="title">View All Skills</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-users"></i><span class="title">Users</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('users.index') }}"><span class="title">All Users</span></a></li>
                <li><a href="{{ route('users.create') }}"><span class="title">Add New User</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-adjust"></i><span class="title">Surveys</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('survey.index') }}"><span class="title">All Surveys</span></a></li>
                <li><a href="{{ route('survey.create') }}"><span class="title">Add New Survey</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-chart-pie"></i><span class="title">Polls</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('poll.index') }}"><span class="title">All Polls</span></a></li>
                <li><a href="{{ route('poll.create') }}"><span class="title">Add New Poll</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-install"></i><span class="title">Suppliers</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('suppliers.index') }}"><span class="title">All Suppliers</span></a></li>
                <li><a href="{{ route('suppliers.create') }}"><span class="title">Add New Supplier</span></a></li>
            </ul>
        </li>
        @endif
        <li class="has-sub"><a href="#"><i class="icon-drive"></i><span class="title">Procurements</span></a>
            <ul class="nav collapse">
                @if(Auth::user()->role->name == 'Admin' && Auth::user()->team->name == 'Procurement')
                <li><a href="{{ route('po.all') }}"><span class="title">All Procurements</span></a></li>
                @endif

                @if(Auth::user()->role->name == 'Admin' && Auth::user()->team->name == 'Accounts')
                    <li><a href="{{ route('po.alldemo') }}"><span class="title">Demo Requested</span></a></li>
                @endif
                @if(Auth::user()->role->name == 'Admin' && Auth::user()->team->name == 'Accounts' || Auth::user()->team->name == 'Management')
                        <li><a href="{{ route('po.allexecute') }}"><span class="title">Execute Requested</span></a></li>
                @endif
                <li><a href="{{ route('po.index') }}"><span class="title">My POs</span></a></li>
                <li><a href="{{ route('po.create') }}"><span class="title">Add New Procurement</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class=" icon-lamp"></i><span class="title">Ideas</span></a>
            <ul class="nav collapse">
                <li><a href="{{ route('idea.create') }}"><span class="title">Add New Idea</span></a></li>
                <li><a href="{{ route('idea.index') }}"><span class="title">View All Ideas</span></a></li>
            </ul>
        </li>

        </li>
        <li class="has-sub"><a href="#"><i class="icon-map"></i><span class="title">Yearly Vacations</span></a>
            <ul class="nav collapse">
                @if(Auth::user()->role->name == 'Admin' && Auth::user()->team->name == 'HR')
                    <li><a href="{{ route('holidays.create') }}"><span class="title">Add New</span></a></li>
                @endif
                <li><a href="{{ route('holidays.index') }}"><span class="title">View All</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-map"></i><span class="title">Missions</span></a>
            <ul class="nav collapse">
                @if(Auth::user()->role->name == 'Admin')
                    <li><a href="{{ route('missions.hr') }}"><span class="title">Users Request</span></a></li>
                @endif
                <li><a href="{{ route('missions.create') }}"><span class="title">Add New</span></a></li>
                <li><a href="{{ route('missions.index') }}"><span class="title">View All</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-map"></i><span class="title">Vacations</span></a>
            <ul class="nav collapse">
                @if(Auth::user()->role->name == 'Admin')
                    <li><a href="{{ route('vacations.hr') }}"><span class="title">Users Request</span></a></li>
                @endif
                <li><a href="{{ route('vacations.create') }}"><span class="title">Add New</span></a></li>
                <li><a href="{{ route('vacations.index') }}"><span class="title">View All</span></a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#"><i class="icon-map"></i><span class="title">Requests form</span></a>
            <ul class="nav collapse">
                @if(Auth::user()->role->name == 'Admin' or Auth::user()->team->name == 'IT')
                    <li><a href="{{ route('forms.create') }}"><span class="title">Add New form</span></a></li>
                    <li><a href="{{ route('forms.index') }}"><span class="title">View All forms</span></a></li>
                @endif
                    <li><a href="{{ route('tasks.create') }}"><span class="title">Add New Request</span></a></li>
                    <li><a href="{{ route('tasks.index') }}"><span class="title">My Requests</span></a></li>
            </ul>
        </li>
        <li><a href="{{ route('account.index') }}"><i class="icon-cog"></i><span class="title">Account Setting</span></a></li>
        <li><a href="{{ route('chat') }}"><i class="icon-chat"></i><span class="title">Chat</span></a></li>
        <li><a href="{{ route('document.index') }}"><i class="icon-upload-cloud"></i><span class="title">Document Center</span></a></li>
        <li>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="icon-logout"></i>
                    <span class="title">Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

    </ul>
    </ul>
    <!-- /main navigation -->
</div>