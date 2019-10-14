@extends('layouts.master')
@section('title') {{ $po->company_name }} @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
    <style>
        .form-control  {
            height: 40px;
        }
        .ui-helper-hidden-accessible{
            display: none;
        }
        .response{
            background: #c5fde1;
        }
    </style>
@endsection
@section('content')





    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $po->company_name }}</div>
                <div class="panel-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Errors !</strong><br>
                            @foreach($errors->all() as $error)
                                {{ $error }} <br/>
                            @endforeach
                        </div>
                    @endif
                        @php
                            switch ($po->status) {
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

                    <div class="cards-container box-view">


                        <div class="card">

                            <!-- Card header -->
                            <div class="card-header">
                                <!-- Card short description -->
                                <div class="card-short-description">
                                    <h5><span class="user-name"><a href="#">{{ $po->company_name }}</a></span><span class="badge badge-primary">#PO:{{ $po->po_number }}</span> <span class="badge badge-{{$bg}}">{{ $stat }}</span> </h5>
                                    <p><b>Employee Name:</b> <a href="#">{{ $po->user->name }}</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp; <b>Supplier Name:</b> <a href="#">{{ $po->supplier->name }}</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp; <b>Delivery Date:</b> <a href="#">{{ $po->deadline }}</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp; <b>Delivery Place:</b> <a href="#">{{ $po->place }}</a>
                                    </p>
                                </div>
                                <!-- /card short description -->

                            </div>
                            <!-- /card header -->

                            <!-- Card content -->
                            <div class="card-content">
                                <p><b>Items (Description): </b><br> {{ $po->items }} </p>
                                <p><b>Details: </b><br> {{ $po->details }} </p>
                            </div>
                            <!-- /card content -->

                        </div>

                        @foreach($po->offers()->orderby('id', 'desc')->get() as $offer)
                            <div class="card response">

                                <!-- Card header -->
                                <div class="card-header">
                                    <!-- Card short description -->
                                    <div class="card-short-description">
                                        <h5><span class="badge badge-bordered"><a href="#">{{ $offer->created_at }}</a></span></h5>
                                        <p>
                                            @foreach($offer->photos as $photo)
                                                <b>file {{ $loop->iteration }}:</b> <a href="{{ URL::asset($photo->path) }}">Download</a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                            @endforeach
                                        </p>
                                    </div>
                                    <!-- /card short description -->

                                </div>
                                <!-- /card header -->

                                <!-- Card content -->
                                <div class="card-content">
                                    <p><b>Notes: </b><br> {{ $offer->notes }} </p>

                                </div>
                                <!-- /card content -->

                            </div>

                        @endforeach

                        @if($po->status == 1)
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <a href="{{route('po.demo', $po->id)}}" class="col-md-6 btn btn-default">Ask for Demo</a>
                                <a href="{{route('po.execute', $po->id)}}" class="col-md-6 btn btn-success">Execute</a>
                            </div>

                            @endif
                    </div>



                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();

            $('#date-popup').datepicker({
                dateFormat: 'dd/mm/y',
                keyboardNavigation: false,
                forceParse: false,
                todayHighlight: true
            });
        });

    </script>

@endsection