@extends('layouts.master')
@section('title')Employee Voting @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Employee of the month</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                             {{ session('status') }}
                        </div>
                    @endif
                        @if (session('edit'))
                            <div class="alert alert-success">
                                {{ session('edit') }} updated successfully
                            </div>
                        @endif
                    <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>Title</th>
                                    <th># of Users</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($surveys as $survey)
                                    <tr class="gradeA" role="row">

                                        <td>{{ $survey->title  }}</td>
                                        <td><a href="{{ route('answer.employee-index', $survey->id) }}" ><i class="fa fa-eye"></i> {{ $survey->answers()->count()  }} </a></td>
                                        <td>{{ $survey->user->name }}</td>
                                        <td>{{ $survey->created_at }}</td>
                                        <td>
                                            @if($survey->status == 0)
                                                <span class="badge badge-default">Deactivated</span>
                                            @else
                                                <span class="badge badge-primary">Activated</span>
                                            @endif
                                        </td>
                                        <td>
                                           
                                            {!! Form::open(['route'=>['survey.destroy', $survey], 'method'=>'DELETE']) !!}

                                            <a href="{{ route('survey.edit', $survey->id) }}" class="btn btn-info"><span class="fa fa-pencil-square"></span> Edit </a>
                                                {{--<button type="submit" class="btn btn-danger"><span class="fa fa-trash-o"></span> </button>--}}



                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th># of Users</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
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
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>


@endsection