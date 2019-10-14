@extends('layouts.master')
@section('title')Groups @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">View All Groups</div>
                <div class="panel-body">
                    <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>Title</th>
                                    <th>User Number</th>
                                    <th>Material Number</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr class="gradeA" role="row">

                                        <td>{{ $group->name  }}</td>
                                        <td>{{ $group->users()->count() }}</td>
                                        <td>{{ $group->materials()->count() }}</td>
                                        <td>{{ $group->created_by }}</td>
                                        <td>{{ $group->created_at }}</td>
                                        <td>
                                           
                                            {!! Form::open(['route'=>['group.destroy', $group], 'method'=>'DELETE']) !!}
                                            
                                             @if($group->users()->count() > 0)
                                            <a href="{{ route('group.users', $group->id) }}" class="btn btn-info"><span class="fa fa-eye"></span> Users </a>
                                            @endif
                                        @if($group->materials()->count() > 0)
                                            <a href="{{ route('group.materials', $group->id) }}" class="btn btn-info"><span class="fa fa-eye"></span> Materials </a>
                                            @endif
                                                <button type="submit" class="btn btn-danger"><span class="fa fa-trash-o"></span> </button>

                                            
                                        
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>User Number</th>
                                    <th>Material Number</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
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
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>


@endsection