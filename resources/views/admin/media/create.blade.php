@extends('layouts.admin')


@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">{{--upload plugin. minified css. js for it below--}}
@stop()

@section('content')

    <h1>Upload Media</h1>


    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediasController@store','class'=>'dropzone']) !!} <!--Add class dropzone to enable dropzone plugin to connect with class and word.-->



    {!! Form::close() !!}



@stop


@section('footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> {{--plugin for upload media. minified js. its styles minified css above--}}
@stop
