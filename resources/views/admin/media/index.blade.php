@extends('layouts.admin')



@section('content')

    <h1>Media</h1>
    {{--added bulk media delete feature. for it to work we create a form around our table--}}
    @if($photos)
        <form action="delete/media" method="POST" class="form-inline">

                {{--         {{csrf_field()}}--}}
                {{--         {{method_field('delete')}}--}}
                <input type="hidden" name="_method" value="delete">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <select name="checkBoxArray" id="" class="form-control">
                    <option value="">Delete</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary form-control" name="delete_all">
                {{--             {!! method_field('delete') !!}--}}
                {{--             {!! csrf_field() !!}--}}

            </div>

            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th><input type="checkbox" id="options"></th>
                    <th>Id</th>
                    <th>Media</th>
                    <th>Created</th>
                    <th>Trash</th>
                </tr>
                </thead>
                <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}">
                        </td>
                        >
                        <td>{{$photo->id}}</td>
                        <td><img height="100" src="{{$photo->file}}" alt=""></td>
                        <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No Date'}}</td>
                        <td>

{{--                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy',$photo->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->--}}



                            <div class="form-group">
{{--                                {!! Form::submit('Trash', ['class'=>'btn btn-danger']) !!}--}}

                                <input type="hidden" name="photo" value="{{$photo->id}}">
                                <input type="submit" name="delete_single"  value="Delete" class="btn btn-danger">
                            </div>


{{--                            {!! Form::close() !!}--}}


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </form>

        <!--was previously like this before bulk media delete feature-->
        {{--<table class="table table-striped table-condensed">--}}
        {{--    <thead>--}}
        {{--      <tr>--}}
        {{--        <th>Id</th>--}}
        {{--        <th>Media</th>--}}
        {{--        <th>Created</th>--}}
        {{--          <th>Trash</th>--}}
        {{--      </tr>--}}
        {{--    </thead>--}}
        {{--    <tbody>--}}
        {{--    @foreach($photos as $photo)--}}
        {{--      <tr>--}}
        {{--        <td>{{$photo->id}}</td>--}}
        {{--        <td><img height="100" src="{{$photo->file}}" alt=""></td>--}}
        {{--        <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No Date'}}</td>--}}
        {{--         <td>--}}

        {{--             {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy',$photo->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->--}}




        {{--             <div class="form-group">--}}

        {{--                 {!! Form::submit('Trash', ['class'=>'btn btn-danger']) !!}--}}
        {{--             </div>--}}


        {{--             {!! Form::close() !!}--}}


        {{--         </td>--}}
        {{--      </tr>--}}
        {{--    @endforeach--}}
        {{--    </tbody>--}}
        {{--  </table>--}}
    @endif



@stop

@section('footer')

    <script>
        $(document).ready(function () {
            $('#options').on('click', function () {
                //grab all checkboxes when top checkbox vlick

                if (this.checked) {//if #options checkbox checked then check each .checkboxes below
                    $(".checkboxes").each(function () {
                        this.checked = true;
                    });

                } else {
                    $(".checkboxes").each(function () {
                        this.checked = false; //this unchecks .checkboxes when #option checkbox is unchecked
                    });

                }
            })

        });
    </script>



@stop