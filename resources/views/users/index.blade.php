@extends('layouts.master')
@section('title')Users @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">
    <style>
        form{
            display: inline-block;
        }


        .badge {
            padding: 7px 16px;
            text-transform: uppercase;
        }
        .badge-primary {
           
            background-color: #014580;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">ALL Users</div>
                 <div class="panel-body">
                     @if (session('status'))
                         <div class="alert alert-success">
                             {{ session('status') }} Created Successfully
                         </div>
                     @endif
                         @if (session('update'))
                             <div class="alert alert-success">
                                 {{ session('update') }} Updated Successfully
                             </div>
                         @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                            <thead>
                            <tr role="row">
                                <th>Full Name</th>
                                <th>E-mail</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Skills</th>
                                <th>Status</th>
                                <th>Settings</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="gradeA" role="row">

                                    <td>{{ $user->name  }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge badge-bordered">{{ $user->role->name }}</span></td>
                                    <td><span class="badge badge-bordered">{{ $user->team->name }}</span></td>
                                    <td>
                                        @foreach($user->skills as $skill)
                                            <span class="badge badge-primary">{{ $skill->name }}</span>
                                            @endforeach
                                    </td>
                                    <td>@if($user->active == 0)
                                        <span class="badge badge-default">Deactivated</span>
                                        @else
                                        <span class="badge badge-primary">Activated</span>
                                        @endif</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info"><span class="fa fa-edit"></span> Edit </a>
                                            @if($user->active == 0)
                                                {!! Form::open(['route'=>['users.activate', $user], 'method'=>'PATCH']) !!}
                                            <button type="submit" class="btn btn-success"><span class="fa fa-caret-square-o-up"></span> Activate </button>

                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['route'=>['users.deactivate', $user], 'method'=>'PATCH']) !!}
                                                    <button type="submit" class="btn btn-danger"><span class="fa fa-caret-square-o-down"></span> Deactivate </button>

                                                {!! Form::close() !!}
                                            @endif
                                            {!! Form::open(['route'=>['users.destroy', $user], 'method'=>'DELETE']) !!}
                                               {{-- <button type="submit" class="btn btn-danger"><span class="fa fa-trash-o"></span> Delete </button>--}}
                                            {!! Form::close() !!}

                                       </td>

                                </tr>

                            @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Full Name</th>
                                <th>E-mail</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Groups</th>
                                <th>Status</th>
                                <th>Settings</th>
                            </tr>
                            </tfoot>
                        </table>
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
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>


@endsection