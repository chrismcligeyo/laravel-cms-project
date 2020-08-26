@extends('layouts.admin')

@section('content')


    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

    <div class="form-group">

        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}


    </div>

    <div class="form-group">

         {!! Form::label('email', 'Email:') !!}
         {!! Form::email('email', null, ['class'=>'form-control']) !!}


     </div>
    <div class="form-group">

        {!! Form::label('photo_id', 'File: ') !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}


    </div>

    <div class="form-group">

        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id',['' => 'Choose Options'] + $roles, null,  ['class'=>'form-control']) !!}  {{--an empty array of choose options concatinaten to roles from database. so select will have roles from databse. function at admin controller at create--}}


    </div>

    <div class="form-group">

        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'),null, ['class'=>'form-control']) !!}  {{--use array to create option values, 0 makes not active default--}}


    </div>

    <div class="form-group">

            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}


        </div>


    <div class="form-group">

        {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
    </div>


    {!! Form::close() !!}

  @include('includes.form_error')
@stop

