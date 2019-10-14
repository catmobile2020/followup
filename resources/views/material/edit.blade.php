@extends('layouts.master')
@section('title') Edit {{ $material->name }} @endsection
@section('styles')
    <link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
    
    <style>
        /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  margin-left: 30px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.mt-20{
    margin-top:20px;
}
    </style>

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
        {!! Form::model($material, ['route'=>['material.update', $material->id], 'method'=>'PATCH', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
        {!! Form::label('name', 'Material Name') !!}
        {!! Form::text('name', null, ['placeholder'=>'Enter Material Name ', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Material Description') !!}
                        {!! Form::text('description', null, ['placeholder'=>'Enter Material Description ', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <div id="date-popup" class="input-group date">
                        {!! Form::label('expiration_date', 'Expiration Date') !!}
                        {!! Form::text('expiration_date', null, ['placeholder'=>'Expiration Date', 'id'=>'year-view', 'class'=>'form-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('current_quantity', 'Quantity') !!}
                        {!! Form::text('current_quantity', null, ['placeholder'=>'Quantity', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        @if(file_exists($material->image))
                            <div class="row">
                                <img src=" {{url($material->image)}}" class="img-thumbnail col-md-4 img-sm"><br>
                            </div>
                        @endif
                        {!! Form::label('image', 'Image') !!}
                        {!! Form::file('image', $attributes = ['class'=>'btn btn-default', 'accept'=>'image/*']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('groups[]', 'Select Group') !!}
                        {!! Form::select('groups[]', $groups->pluck('name','id'), $material->groups, ['class' => 'select2 form-control', 'data-placeholder'=>'Select Group', 'multiple']) !!}

                    </div>
                    
                    <div class="form-group mt-20">
                        
                        {!! Form::label('Active', 'Active') !!}
                        <label class="switch">
                          {!! Form::checkbox('active', null, $material->active) !!}
                          <span class="slider round"></span>
                        </label>
                        <span class="help-block m-b-none">@if($material->active == 0) This item is deactivated @else This item is activated @endif</span>
                        

                    </div>

                {!! Form::submit('Update Material' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

    <script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js')}}"></script>

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
        });

    </script>

@endsection