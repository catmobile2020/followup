@extends('layouts.master')
@section('title')Materials @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">
    <style>
        
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
                @if (session('status'))
                    <div class="alert alert-success">
                        Material {{ session('status') }} has been created
                    </div>
                @endif

                    @if (session('edit'))
                        <div class="alert alert-info">
                            Material {{ session('edit') }} has been Updated
                        </div>
                    @endif

                    @if (session('quantity'))
                        <div class="alert alert-info">
                            Material {{ session('quantity')->name }} quantity  has been Updated to {{ session('quantity')->current_quantity }}
                        </div>
                    @endif
                <div class="panel-body">
                    <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>Picture</th>
                                    <th>Title</th>
                                    <th>Current Quantity</th>
                                    <th>Groups</th>
                                    <th>Status</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($materials as $material)
                                    <tr class="gradeA" role="row">
                                        <td>@if($material->image <> null) 
                                        @if(file_exists($material->image))<img src="{{ URL::asset($material->image) }}" width="150">   @endif @else <img src="http://via.placeholder.com/140x100"> @endif</td>
                                        <td>{{ $material->name  }}</td>
                                        <td>{{ $material->current_quantity }}</td>
                                        <td>
                                        @foreach($material->groups as $group)
                                            <span class="badge badge-primary">{{ $group->name }}</span>
                                            @endforeach
                                    </td>
                                        <td>@if($material->active == 0)
                                        <span class="badge badge-default">Deactivated</span>
                                        @else
                                        <span class="badge badge-primary">Activated</span>
                                        @endif</td>
                                        <td>{!! Form::open(['route'=>['material.destroy', $material], 'method'=>'DELETE']) !!}
                                            <div class="small-12 column">
                                                <a href="{{ route('material.edit', $material->id) }}" class="btn btn-info" title="Edit Material"><span class="fa fa-pencil-square"></span> </a>
                                                {{--<button type="submit" class="btn btn-danger" title="Delete Material"><span class="fa fa-trash-o"></span> </button>--}}
                                                <a href="{{ route('material.log', $material->id) }}" class="btn btn-primary" title="View Log"><span class="fa fa-eye"></span> </a>
                                                <a href="{{ route('add.quantity', $material->id) }}" class="btn btn-success" title="Add Quantity"><span class="fa fa-plus-square"></span> </a>
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Picture</th>
                                    <th>Title</th>
                                    <th>Current Quantity</th>
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
                            columns: [1, 2,3,4]
                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>


@endsection