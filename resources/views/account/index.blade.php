@extends('layouts.master')
@section('title')Users @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="panel-title"><h1>{{ $user->name }}</h1></div>

                    <div class="card-header">

                        <!-- Card photo -->
                        <div class="col-md-3">
            @if(count($user->photos) > 0) @foreach($user->photos as $photo) @if($photo->path || file_exists($photo->path))<img class="img img-thumbnail" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @else <img class="img img-thumbnail" src="http://via.placeholder.com/140x100"> @endif
                        </div>
                        <!-- /card photo -->

                        <!-- Card short description -->
                        <div class="card-short-description col-md-8">
                            <h5><span class="user-name"><a href="#/">{{ $user->username }}</a></span></h5>
                            <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a> &nbsp;<span class="badge @if($user->active == 0) badge-danger @else badge-success @endif "> @if($user->active == 0)Inactive @elseif($user->active == 1) Active @endif </span></p>
                            <p><a href="#">{{ $user->country }}</a></p>
                            <p><a href="{{ route('users.changePassword', $user->id) }}">change password</a> | <a href="{{ route('users.edit', $user->id) }}">Update Profile</a></p>
                        </div>
                        <!-- /card short description -->

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>



@endsection

@section('scripts')

    <script src="{{URL::asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datatables/extensions/Buttons/js/buttons.html5.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons" B>lTfgitp',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>


@endsection