@extends('layouts.master')
@section('title')Statistics @endsection
@section('styles')
<style>
    .dangers{
            color: #ffffff !important;
    background-color: #db2c2c !important;
    border-color: #bb3038 !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@if(Auth::user()->team->name == 'Management') Statistics @else Dashboard @endif</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					@if(Auth::user()->team->name == 'Management')
                    <div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">All Departments</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order">
							<h1 class="no-margins">{{ $teams }}</h1>
							<small>Number of Departments</small>
						</div>
						<div class="bar-chart-icon"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">All Roles</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order">
							<h1 class="no-margins">{{ $roles }}</h1>
							<small>Number of User Type [Roles]</small>
						</div>
						<div class="bar-chart-icon"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">All User</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order">
							<h1 class="no-margins">{{ $all_users }}</h1>
							<small>Number of All Users</small>
						</div>
						<div class="bar-chart-icon"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading dangers clearfix">
						<div class="panel-title">Deactivated Users</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order">
							<h1 class="no-margins">{{ $deact_users }}</h1>
							<small>Number of All Deactivated Users</small>
						</div>
						<div class="bar-chart-icon"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">All Skills</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order">
							<h1 class="no-margins">{{ $skills }}</h1>
							<small>Number of All Skills</small>
						</div>
						<div class="bar-chart-icon"></div>
					</div>
				</div>
			</div>


			
		</div>
                   @else
						welcome to dashboard {{ Auth::user()->name }}
					@endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
