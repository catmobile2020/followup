@extends('layouts.master')
@section('title')Departments @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">View All Departments</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if (session('edit'))
                            <div class="alert alert-success">
                                {{ session('edit') }} Updated Successfully
                            </div>
                        @endif
                    <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>subject</th>
                                    <th>Description</th>
                                    <th>Attachments</th>
                                    <th>Replies</th>
                                    <th>Sender</th>
                                    <th>Receiver(s)</th>
                                    <th>Created At</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ideas as $idea)
                                    <tr class="gradeA" role="row">

                                        <td>{{ $idea->subject  }}</td>
                                        <td>{{ str_limit(strip_tags($idea->description), 25) }}</td>
                                        <td>
                                            @if($idea->attaches()->count() > 0)
                                            {{ $idea->attaches()->count() }} <i class="icon-attach"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($idea->replies()->count() > 0)
                                                {{ $idea->replies()->count() }} <i class="icon-comment"></i>
                                            @endif
                                        </td>
                                        <td><span class="badge badge-warning">{{ $idea->user->name }}</span></td>
                                        <td>
                                            @foreach($idea->users as $user)
                                                <span class="badge badge-primary">{{ $user->name }}</span>
                                                @endforeach
                                        </td>
                                        <td>{{ $idea->created_at }}</td>

                                        <td>
                                           <a href="{{ route('idea.show', $idea->id) }}"><i class="icon-book-open"></i> View Idea</a>

                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>subject</th>
                                    <th>Description</th>
                                    <th>Attachments</th>
                                    <th>Replies</th>
                                    <th>Sender</th>
                                    <th>Receiver(s)</th>
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
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>


@endsection