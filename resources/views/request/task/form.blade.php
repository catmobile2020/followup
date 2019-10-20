@extends('layouts.master')
@section('title') Request @endsection
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
                    @if ($form_action['method'] == 'PATCH')
                        <input type="hidden" name="request_form_id" value="{{$task->request_form_id}}" />
                        @include('request.task.elements',$elements)
                     @else
                        <div class="form-group">
                            <label>Select Form</label>
                            <select name="request_form_id" class="form-control changeForm">
                                <option value selected disabled>Select Form</option>
                                @foreach($forms as $val=>$name)
                                    <option value="{{$val}}">{{$name}}</option>
                                @endforeach
                            </select>
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
        let request_form_id = $(this).val();
        $.ajax({
            url:'{{route('tasks.change-form')}}',
            data:{request_form_id:request_form_id},
            success:function (result) {
                $('#insertFormData').html(result);
            },
            error:function (errors) {
                console.log(errors);
            }
        });
    })
</script>
@endsection