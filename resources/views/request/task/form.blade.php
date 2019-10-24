@extends('layouts.master')
@section('title') Request @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
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

                    {!! Form::model($task,['url'=>$form_action['url'], 'method'=>$form_action['method']]) !!}
                    <div class="form-group">
                        <label>PO Number</label>
                        <input name="po" type="text" class="form-control" value="{{$task->po}}">
                    </div>
                    @if ($form_action['method'] == 'PATCH')
                        <input type="hidden" name="request_form_id" value="{{$task->request_form_id}}" />
                        @include('request.task.elements',$elements)
                    @else
                        <div class="form-group">
                            <label>Select Department</label>
                            <select name="team_id" class="form-control changeForm" data-type="department">
                                <option value selected disabled>Select Department</option>
                                @foreach($departments as $val=>$department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="insertDepartData">

                        </div>
                        <div id="insertFormData">

                        </div>
                    @endif
                    {!! Form::submit('Submit!' , ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).on('change','.changeForm',function () {
            let id = $(this).val();
            let type = $(this).data('type');
            let loadinf = ` <img src="{{asset('images/loading-gif.gif')}}" alt='loading...' width="100%">`;
            $('#insertFormData').html(loadinf);
            $.ajax({
                url:'{{route('tasks.change-form')}}',
                data:{id:id,type:type},
                success:function (result) {
                    if (type == 'form')
                    {
                        $('#insertFormData').html(result);
                    }else
                    {
                        $('#insertFormData').html('');
                        $('#insertDepartData').html(result);
                    }
                },
                error:function (errors) {
                    console.log(errors);
                }
            });
        })
    </script>
    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/summernote/summernote.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });

        $('#textarea').summernote({
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