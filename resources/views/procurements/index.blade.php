@extends('layouts.master')
@section('title')MY Procurements @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">View My Procurements</div>
                <div class="panel-body">
                    @if (session('status'))
                        <script>
                            swal({
                                title: " {{ session('status') }}",
                                text: "Created Successfully",
                                icon: "success",
                                button: "Exit",
                            });
                        </script>

                    @endif
                        @if (session('demo'))
                        <script>
                            swal({
                                title: "{{ session('demo') }}",
                                text: "You applied for Demo!",
                                icon: "success",
                                button: "Exit",
                            });
                        </script>
                        @endif
                        @if (session('execute'))
                            <script>
                                swal({
                                    title: "{{ session('execute') }}",
                                    text: "You asked for execute!",
                                    icon: "success",
                                    button: "Exit",
                                });
                            </script>
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
                                    <th>Company Name</th>
                                    <th>PO Number</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Deliver Date</th>
                                    <th>Deliver Place</th>
                                    <th>status</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Auth::user()->procurements as $procurement)
                                    @php
                                        switch ($procurement->status) {
                                                case 1:
                                                $bg = 'success';
                                                $stat = 'Confirmed from procurement manager';
                                                break;
                                                case 2:
                                                $bg = 'info';
                                                $stat = 'pending(Demo requested)';
                                                break;
                                                 case 3:
                                                $bg = 'info';
                                                $stat = 'pending(Execute requested)';
                                                break;
                                                case 4:
                                                $bg = 'success';
                                                $stat = 'Accountant has confirmed your request';
                                                break;
                                                case 5:
                                                $bg = 'danger';
                                                $stat = 'Accountant has rejected your request';
                                                break;
                                                case 6:
                                                $bg = 'success';
                                                $stat = 'Manager has confirmed your request';
                                                break;
                                                case 7:
                                                $bg = 'danger';
                                                $stat = 'Manager has rejected your request';
                                                break;
                                            default:
                                                 $bg = 'disabled';
                                                 $stat = 'Pending (waiting for Price Offer)';
                                        }
                                    @endphp
                                    <tr class="gradeA {{ $bg }}" role="row">

                                        <td>{{ $procurement->company_name  }}</td>
                                        <td>{{ $procurement->po_number  }}</td>
                                        <td>{{ $procurement->created_at }}</td>
                                        <td>{{ $procurement->supplier->name }}</td>
                                        <td>{{ $procurement->deadline }}</td>
                                        <td>{{ $procurement->place }}</td>
                                        <td>{{ $stat }}</td>
                                        <td>
                                           
                                            {!! Form::open(['route'=>['po.destroy', $procurement], 'method'=>'DELETE']) !!}
                                            <a href="{{ route('po.show', $procurement->id) }}" class="btn btn-success"><span class="fa fa-product-hunt"></span> view {{ $procurement->name }} </a>


                                            <a href="{{ route('po.edit', $procurement->id) }}" class="btn btn-info"><span class="fa fa-pencil-square"></span> Edit {{ $procurement->name }} </a>

                                            <button type="submit" class="btn btn-danger"><span class="fa fa-trash-o"></span> </button>

                                            
                                        
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Company Name</th>
                                    <th>PO Number</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Deliver Date</th>
                                    <th>Deliver Place</th>
                                    <th>status</th>
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
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>

@endsection