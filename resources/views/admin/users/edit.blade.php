@extends('layouts.admin')

@section('content')

    <div class="col-sm-3">

        <img height="100" src="{{$user->photo ? $user->photo->file : 'https://via.placeholder.com/400'}}" class="img-responsive img-rounded" alt="">{{--if user photo is there display usr photo, if not display photo placeholder--}}

    </div>

    <div class="col-sm-9">
    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update',$user->id], 'files'=>true]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data. method form model displays individual user data details in form-->

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



                <div class="form-group ">

                    {!! Form::submit('Edit User', ['class'=>'btn btn-primary col-sm-6 ']) !!}{{--used col sm 6 so as to enable edit and delete button fit side by side--}}
                </div>


                {!! Form::close() !!}


        {{--    delete form--}} {{--pullthe delete button to the right instead of it being under edit--}}



            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->
    {{----}}


                <div class="form-group ">

                    {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6' ]) !!}
                </div>

                {!! Form::close() !!}

    </div>



        @include('includes.form_error')
        @stop



    </div>

  