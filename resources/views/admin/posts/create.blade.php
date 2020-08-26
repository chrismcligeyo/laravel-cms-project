@extends('layouts.admin')

@section('content')
    {{--include tiny ck editor after installing laravel file manager.use tinyco to intergrate. then add package for image--}}
    @include('includes/tiny_ck_editor')

    <h1>Create</h1>

    <div class="row">
    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store','files'=>true]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

    <div class="form-group">

        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}


    </div>

    <div class="form-group">

            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', ['' => 'Choose Options'] + $category , null, ['class'=>'form-control']) !!} {{--array(1=>'Choose PHP', 0=>'Javascript')--}}
            {{--above pulls out category names from database and displays it in select input--}}

        </div>

    <div class="form-group">

            {!! Form::label('Photo_id', 'Photo') !!}
            {!! Form::file('photo_id',null, ['class'=>'btn btn-primary']) !!}
        </div>

    <div class="form-group">

            {!! Form::label('body', 'Description:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}


        </div>


    <div class="form-group">

        {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
    </div>


    {!! Form::close() !!}
    </div>

    <div class="row">
        @include('includes.form_error') {{--error message to be displayed if required field--}}
    </div>


@endsection