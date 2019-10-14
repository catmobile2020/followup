@extends('layouts.master')
@section('title') Send New Idea @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
@endsection
@section('content')





    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">View Message</div>
                <div class="panel-body">


                        <div class="mail-box">
                            <div class="mail-box-header clearfix">
                                <h3 class="mail-title">View Message</h3>
                                <div class="pull-right tooltip-demo">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="btn btn-white btn-sm" href="mail-compose.html" data-original-title="Reply"><i class="fa fa-reply"></i> Reply</a>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="btn btn-white btn-sm" href="#/" data-original-title="Print email"><i class="fa fa-print"></i> </a>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="btn btn-white btn-sm" href="#/" data-original-title="Move to trash"><i class="fa fa-trash-o"></i> </a>
                                </div>
                                <div class="mail-tools clearfix">
                                    <h4 class="title">Subject: {{ $idea->subject }}.</h4>
                                    <p><span class="pull-right">{{ $idea->created_at }}</span><span>From: {{ $idea->user->name }} [{{ $idea->user->team->name }}] </span></p>
                                </div>
                            </div>
                            <div class="mail-body">
                                {!! $idea->description !!}
                                <hr>
                                <h4><i class="fa fa-paperclip"></i> &nbsp; <strong>Attachments <span>({{ $idea->attaches()->count() }})</span></strong></h4>
                                <ul class="list-unstyled list-inline mail-attachment">
                                    @foreach($idea->attaches as $attach)
                                        @php
                                            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                                            $explodeImage = explode('.', $attach->path);
                                            $extension = end($explodeImage);
                                            if(in_array($extension, $imageExtensions))
                                            {
                                            echo '<li><a target="_blank" href="'. URL::asset($attach->path) .'"><img class="img-thumbnail img-responsive" alt="attachment" src="'. URL::asset($attach->path) .'"></a></li>';
                                            }else
                                            {
                                            echo '<li><a target="_blank" href="'. URL::asset($attach->path) .'"><i class="icon-docs"></i> Download Document</a></li>';
                                            }
                                        @endphp
                                    @endforeach
                                </ul>


                            @foreach($idea->replies()->orderBy('id','desc')->get() as $reply)
                                <hr>
                                <div style="width:100%; height: 32px; padding: 7px; background-color: #0c0c0c; color: #f2f3f5">
                                    <h3 class="mail-title">View Reply</h3>
                                    <div class="pull-right tooltip-demo">
                                        <span class="pull-right">{{ $reply->created_at }}</span>
                                    </div>
                                </div>

                                    <div class="mail-tools clearfix">
                                        <p><span>By: {{ $reply->user->name }} [{{ $reply->user->team->name }}] </span></p>
                                    </div>
                            </div>
                            <div class="mail-body">
                                {!! $reply->description !!}
                                <hr>
                                <h4><i class="fa fa-paperclip"></i> &nbsp; <strong>Attachments <span>({{ $reply->attaches()->count() }})</span></strong></h4>
                                <ul class="list-unstyled list-inline mail-attachment">
                                    @foreach($reply->attaches as $attach)
                                        @php
                                            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                                            $explodeImage = explode('.', $attach->path);
                                            $extension = end($explodeImage);
                                            if(in_array($extension, $imageExtensions))
                                            {
                                            echo '<li><a target="_blank" href="'. URL::asset($attach->path) .'"><img class="img-thumbnail img-responsive" alt="attachment" src="'. URL::asset($attach->path) .'"></a></li>';
                                            }else
                                            {
                                            echo '<li><a target="_blank" href="'. URL::asset($attach->path) .'"><i class="icon-docs"></i> Download Document</a></li>';
                                            }
                                        @endphp
                                    @endforeach
                                </ul>


                            @endforeach




                                <hr>

                                {!! Form::open(['route'=>'idea.reply', 'method'=>'POST', 'files'=>true]) !!}
                                <div class="form-group">
                                    {!! Form::hidden('created_by', Auth::user()->id ) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::hidden('idea', $idea->id ) !!}
                                </div>
                                <div class="form-group">
                                    <textarea name="description" class="form-control" id="description" title="IDEA Description....">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('attaches', 'Attachment(s)') !!}
                                    {!! Form::file('attaches[]', ['class'=>'form-control', 'multiple'=>true]) !!}
                                </div>

                                {!! Form::submit('Reply' , ['class'=>'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/summernote/summernote.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });

        $('#description').summernote({
            height: 260,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                  // set focus to editable area after initializing summernote
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
        });

    </script>

@endsection