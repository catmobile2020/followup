@extends('layouts.master')
@section('title') {{ $material->name }} Logs @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
<style>
    html, body, content, container{
        background:#fff;
    }
</style>
@endsection
@section('content')




<button id="print" class="btn btn-primary">
<i class="fa fa-print"></i> print
</button>
<div class="row" id="content">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

            <div class="panel-body">
                @if($material->current_quantity <= 50)
                    <div class="alert alert-warning"> This Material has less Than 50 items in stock</div>
                    @endif

                @php
                    $carbon = new \Carbon\Carbon($material->expiration_date);
                    $alert = $carbon->subMonths(2);

                if(\Carbon\Carbon::now()->gte($alert)){
                echo "<div class='alert alert-warning'> There is less than 2 Months till Expiration Date</div>";
                }
                @endphp

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

                        <div class="row">
                            @if(file_exists($material->image))
                            <img src=" {{url($material->image)}}" class="img-thumbnail col-md-6 col-md-offset-3 img-sm"><br>
                            @endif
                            <h1 class="title col-md-12 text-center">{{ $material->name }}</h1>
                            <p class="col-md-12 text-center"> {{ $material->description }}</p>
                            <p class="col-md-12 text-center"> @foreach($material->groups->pluck('name') as $group) <span class="badge badge-primary">{{ $group }}</span> @endforeach </p>
                            <p class="col-md-12 text-center"> <b>Created By:</b> {{ $material->user->name }}</p>
                            <p class="col-md-6 text-center"> <b>Current Quantity:</b> {{ $material->current_quantity }}</p>
                            <p class="col-md-6 text-center"> <b>Expiration Date:</b> {{ $material->expiration_date }}</p>
                        </div>
                        <div class="row">
                            <div class="line-dashed"></div>
                            <h1 class="title text-center"> Logs</h1>

                            @foreach($material->logs()->latest()->get() as $log)

                                <div class="alert alert-info">
                                    <span class="badge badge-default">{{ \Carbon\Carbon::parse($log->created_at)->format('F j, Y, g:i a')}} </span> &nbsp; <b>{{ $log->user->name }}</b>
                                    @if($log->status == 0 )
                                        <b style="font-size: 14px; font-weight: bold">Created</b>
                                        @elseif($log->status == 1)
                                        <b style="font-size: 18px; font-weight: bold">added to</b>
                                        @else
                                        <b>take from</b>
                                        @endif

                                    <b>{{ $log->material->name }}</b>&nbsp; &nbsp; &nbsp; <span class="badge badge-bordered">{{ $log->quantity }} items</span>
                                </div>

                                @endforeach
                        </div>


            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

    <script>
        $(document).ready(function () {
            $('#date-popup').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                todayHighlight: false,
                format: "yyyy-mm-dd",
                startDate: '+7d',
            });


            $(".select2").select2();
            
            var doc = new jsPDF('p', 'pt', 'a4');
            doc.internal.scaleFactor = 2.25;
            var options = {
                 pagesplit: true
            };
            $('#print').on('click', function(){
                
            doc.addHTML(document.getElementById("content"), 0, 0, options, function() {
                doc.save('Log'+ new Date() +'.pdf');
            });
            });
        });

    </script>

@endsection