@extends('layouts.master')
@section('title')Requests Elements @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <a href="{{route('elements.create',$form->id)}}" class="btn btn-success">Add New</a>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                            <thead>
                            <tr role="row">
                                <th>#</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Validation</th>
                                <th>Settings</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr class="gradeA" role="row">
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{!! $row->title !!}</td>
                                    <td>{{ $row->type }}</td>
                                    <td>{{ $row->value }}</td>
                                    <td>{{ $row->validation ? 'YES' : 'NO' }}</td>
                                    <td>
                                        {!! Form::open(['route'=>['elements.destroy',$row->request_form_id,$row->id], 'method'=>'DELETE']) !!}
                                        <div class="small-12 column">
                                            <button type="submit" class="btn btn-danger"><span class="fa fa-trash-o"></span> </button>
                                            <a href="{{route('elements.edit',[$row->request_form_id,$row->id])}}" class="btn btn-success"><span class="fa fa-edit"></span> </a>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr role="row">
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Settings</th>
                            </tr>
                            </tfoot>
                        </table>
                        {!!  $rows->links() !!}
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