@extends('layouts.master')
@section('title')Documents Center @endsection
@section('styles')

    <link href="{{URL::asset('css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">
    <style>
        .main-li {
            background: #e7e7e7;
            border-radius: 7px;
            margin: 5px 7px;
        }

        /*.main-li:hover, .main-li:hover small{*/
            /*background: #636b6f;*/
            /*color: #fff !important;*/
            /*cursor: pointer;*/
        /*}*/
        .badge-bordered:hover{
            color: #fff;
            background: #636b6f;
        }
        .p-5{
            padding: 5px;
            width:170px !important;
        }

        .list-inline {
            padding-left: 0;
            margin-left: 40px;
            list-style: none;
        }


    </style>

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-2">
            <ul class="list-unstyled mail-list">
                <li>
                    <a href="{{ route('document.my', Auth::id()) }}"><i class="fa fa-file"></i> My Documents</a>
                </li>
                <li>
                    <a href="{{ route('document.index') }}"><i class="fa fa-files-o"></i> All Files</a>
                </li>
                <li>
                    <a href="{{ route('document.create') }}"><i class="fa fa-upload"></i>New Document</a>
                </li>
            </ul>

            <h3 class="title text-uppercase m-l-20">Categories</h3>
            <ul class="list-unstyled category-list">
                <li><a href="#"> <i class="fa fa-circle text-purple"></i> HR </a></li>
                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Management</a></li>
                <li><a href="#"> <i class="fa fa-circle text-danger"></i> Announcement</a></li>
                <li><a href="#"> <i class="fa fa-circle text-primary"></i> Social</a></li>
                <li><a href="#"> <i class="fa fa-circle text-info"></i> Other</a></li>
            </ul>

        </div>
        <div class="col-lg-10">

            <div class="mail-box">
                <div class="mail-box-header clearfix">
                    <h3 class="mail-title">Documents Center</h3>
                </div>
                <div class="mail-body">
                    <ul class="list-unstyled list-inline mail-attachment">
                        @foreach($documents as $document)
                            <li class="main-li">
                            @if($document->type == 'picture')
                        <a href="{{ URL::asset($document->path) }}"><img class="img-thumbnail img-responsive" alt="attachment" src="{{ URL::asset($document->path) }}"></a>
                            @elseif($document->type == 'pdf')
                        <a href="{{ URL::asset($document->path) }}"><img class="img-thumbnail img-responsive" alt="attachment" src="{{ URL::asset('uploads/documents/icons/pdf.png') }}"></a>
                            @elseif($document->type == 'document')
                        <a href="{{ URL::asset($document->path) }}"><img class="img-thumbnail img-responsive" alt="attachment" src="{{ URL::asset('uploads/documents/icons/word.png') }}"></a>
                            @elseif($document->type == 'adobe')
                        <a href="{{ URL::asset($document->path) }}"><img class="img-thumbnail img-responsive" alt="attachment" src="{{ URL::asset('uploads/documents/icons/art.png') }}"></a>
                            @elseif($document->type == 'excel')
                        <a href="{{ URL::asset($document->path) }}"><img class="img-thumbnail img-responsive" alt="attachment" src="{{ URL::asset('uploads/documents/icons/excel.png') }}"></a>
                            @elseif($document->type == 'archive')
                        <a href="{{ URL::asset($document->path) }}"><img class="img-thumbnail img-responsive" alt="attachment" src="{{ URL::asset('uploads/documents/icons/archive.png') }}"></a>
                            @else
                        <a href="{{ URL::asset($document->path) }}"><img class="img-thumbnail img-responsive" alt="attachment" src="{{ URL::asset('uploads/documents/icons/other.png') }}"></a>
                            @endif
                            <ul class="list-unstyled">
                                <li class="p-5">
                                    <h5>
                                        @if($document->category == 1)
                                            <i class="fa fa-circle text-purple"></i>
                                            <small> [HR]
                                        @elseif($document->category == 2)
                                            <i class="fa fa-circle text-warning"></i>
                                            <small> [MANAGEMENT]
                                        @elseif($document->category == 3)
                                            <i class="fa fa-circle text-danger"></i>
                                            <small> [ANNOUNCEMENT]
                                        @elseif($document->category == 4)
                                            <i class="fa fa-circle text-primary"></i>
                                            <small>[SOCIAL]
                                        @else
                                            <i class="fa fa-circle text-info"></i>
                                            <small> [OTHER]
                                        @endif
                                            </small>

                                    </h5>
                                    <h4> {{ $document->title }}</h4>
                                <p>
                                    uploaded by: <b>{{ $document->user->name }}</b>
                                    <br>
                                    <code>{{ $document->created_at }}</code>

                                </p>
                                    <a href="{{ URL::asset($document->path) }}" class=" badge badge-bordered"><i class="fa fa-download"></i> download</a>

                                </li>
                            </ul>
                        </li>
                        @endforeach

                    </ul>
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