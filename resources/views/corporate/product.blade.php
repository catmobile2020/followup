@extends('layouts.master')
@section('title') Create New Prodcut @endsection
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
        {!! Form::open(['route'=>'product.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                    {!! Form::label('title', 'Product Name') !!}
                    {!! Form::text('title', null, ['placeholder'=>'Enter Product Name !!', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('price', 'Product Price') !!}
                        {!! Form::text('price', null, ['placeholder'=>'Enter Product price !!', 'class'=>'form-control price']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('category_id', $category->id) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('image', 'Image') !!}
                        {!! Form::file('image', $attributes = ['class'=>'btn btn-default', 'accept'=>'image/*']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', null, ['placeholder'=>'Your description Here !!', 'rows'=> '4', 'class'=>'form-control']) !!}
                    </div>

                {!! Form::submit('Create Product!!' , ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection