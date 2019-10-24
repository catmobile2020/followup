@extends('layouts.master')
@section('title')Requests Form @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                            <thead>
                            <tr role="row">
                                <th>#</th>
                                <th>PO</th>
                                <th>Department Name</th>
                                <th>Form Title</th>
                                <th>Request Owner</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr class="gradeA" role="row">
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $row->po}}</td>
                                    <td>{{ $row->form->team->name}}</td>
                                    <td>{!! $row->form->title !!}</td>
                                    <td>{!! $row->user->name !!}</td>
                                    <td>
                                        @if(Auth::user()->role->name == 'Admin' && Auth::user()->team->name == 'Accounts')
                                        <select class="form-control changeStatus" name="active" data-id="{{$row->id}}">
                                            <option value="0" {{$row->active == '0' ? 'selected' : ''}}>Pending</option>
                                            <option value="1" {{$row->active == '1' ? 'selected' : ''}}>Agree</option>
                                            <option value="-1" {{$row->active == '-1' ? 'selected' : ''}}>DisAgree</option>
                                        </select>
                                        @else
                                            <span class="badge badge-{{ $row->active == 1 ? 'success' : 'danger' }}">{{ $row->active_name}}</span>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr role="row">
                                <th>#</th>
                                <th>PO</th>
                                <th>Department Name</th>
                                <th>Form Title</th>
                                <th>Request Owner</th>
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
        $(document).on('change','.changeStatus',function () {
            let value = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                data:{active:value,id:id},
                success:function (result) {
                    console.log(result)
                },
                error:function (errors) {
                    console.log(errors)
                }
            });
        });
    </script>
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