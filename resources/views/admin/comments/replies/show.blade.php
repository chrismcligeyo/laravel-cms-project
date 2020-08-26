{{--show comments belonging to a post--}}

@extends('layouts.admin')


@section('content')
    <h1 class="text-center">Replies</h1>

    @if(count($replies) > 0)


        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post</th>
            </tr>
            </thead>
            <tbody>

            {{--loop through comments and display them in comments section--}}

            @foreach($replies as $reply)

                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{str_limit($reply->body, 30)}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>

                    <td>

                    {{--un-approve and approve comments--}}
                    {{--if comments are inactive approve button appears on side, if comments are active un-approve button appears--}}

                    @if($reply->is_active == 1) {{--if comment is active, set it to 0(which is not active) in value in input type hidden--}}
                    {!! Form::model($reply,['method'=>'PUT', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}  <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

                        <input type="hidden" name="is_active" value="0">{{--means if comment is active change value to 0(inactive)- when unapprove button clicked--}}

                        {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}
                        </div>


                    {!! Form::close() !!}

                    @else {{--if not active(1), create a button to make it active--}}
                    {!! Form::open(['method'=>'PUT', 'action'=>['CommentRepliesController@update', $reply->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

                        <input type="hidden" name="is_active" value="1">{{----}}

                        {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                        </div>


                        {!! Form::close() !!}
                        @endif

                    </td>

                    <td>
                    {{--add delete button--}}

                    {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy',$reply->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->



                        <div class="form-group">

                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>


                        {!! Form::close() !!}


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <h1 class="text-center">No Replies</h1>
    @endif

@stop