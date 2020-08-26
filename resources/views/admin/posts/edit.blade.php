@extends('layouts.admin')

@section('content')


    <h1>Create</h1>

    @extends('layouts.admin')

@section('content')

    <h1>Edit</h1>

    <div class="row">
        <div class="col-sm-3">
            <img src="{{$post->photo->file}}" height="50" alt="" class="img-responsive">
        </div>

                <div class="col-sm-9">
                    {!! Form::model($post,['method'=>'PATCH', 'action'=> ['AdminPostsController@update', $post->id], 'files' =>true]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

                            <div class="form-group">

                                {!! Form::label('title', 'Title') !!}
                                {!! Form::text('title', null, ['class'=>'form-control']) !!}


                            </div>

                                <div class="form-group">

                                    {!! Form::label('category_id', 'Category') !!}
                                    {!! Form::select('category_id', $category , null, ['class'=>'form-control']) !!} {{--array(1=>'Choose PHP', 0=>'Javascript')--}}
                                    {{--above pulls out category names from database and displays it in select input--}}

                                </div>

                                    <div class="form-group">

                                        {!! Form::label('photo_id', 'Photo') !!}
                                        {!! Form::file('photo_id',null, ['class'=>'btn btn-primary']) !!}
                                    </div>

                                        <div class="form-group">

                                            {!! Form::label('body', 'Description:') !!}
                                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}


                                        </div>


                                            <div class="form-group">

                                                {!! Form::submit('Update', ['class'=>'btn btn-primary col-sm-6']) !!}
                                            </div>


                        {!! Form::close() !!}

                        {{--delete form--}}
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

                        <div class="form-group">

                            {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6']) !!}
                        </div>


                        {!! Form::close() !!}
                </div>
    </div>

    <div class="row">
        @include('includes.form_error') {{--error message to be displayed if required field--}}
    </div>


@endsection


@endsection