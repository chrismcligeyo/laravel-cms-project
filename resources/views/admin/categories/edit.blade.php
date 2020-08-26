@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    <div class="row">
        <div class="col-sm-6">
        {!! Form::model($category,['method'=>'PUT', 'action'=>['AdminCategoriesController@update',$category->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

            <div class="form-group">

                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}


            </div>



            <div class="form-group">

                {!! Form::submit('Update', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>


            {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy',$category->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->




            <div class="form-group">

                {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6']) !!}
            </div>


            {!! Form::close() !!}

        </div>





    </div>




@stop