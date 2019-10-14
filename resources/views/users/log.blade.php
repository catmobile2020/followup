@extends('layouts.master')
@section('title') {{ $user->name }} Logs @endsection
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
                            @if($user->photos)
                                @foreach($user->photos as $photo)
                                    <img src=" {{url($photo->path)}}" class="img-thumbnail col-md-6 col-md-offset-3 img-sm"><br>
                                @endforeach
                            @endif

                            <h1 class="title col-md-12 text-center">{{ $user->name }}</h1>
                            <p class="col-md-12 text-center"> {{ $user->email }}</p>
                            <p class="col-md-12 text-center"> @if($user->groups)@foreach($user->groups->pluck('name') as $group) <span class="badge badge-primary">{{ $group }}</span> @endforeach @endif </p>
                            <p class="col-md-6 text-center"> <b>Created Date:</b> {{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y, g:i a') }}</p>
                        </div>
                        <div class="row">
                            <div class="line-dashed"></div>
                            <h1 class="title text-center"> Logs</h1>

                            @foreach($user->logs()->latest()->get() as $log)

                                <div class="alert alert-info">
                                    <span class="badge badge-default">{{ \Carbon\Carbon::parse($log->created_at)->format('F j, Y, g:i a')}} </span> &nbsp; <b>{{ $user->name }}</b>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    
    <script>
        $(document).ready(function () {
           



            var doc = new jsPDF('p', 'pt', 'a4');
            
            doc.internal.scaleFactor = 2.25;
            
            var options = {
                 pagesplit: true
            };
            
            $('#print').on('click', function(){
                
            doc.addHTML(document.getElementById("content"), 0, 0, options, function() {
                doc.save('UserLog'+ new Date() +'.pdf');
            });
            
            });
        });

    </script>

@endsection