@extends('layouts.admin')


@section('content')

    @if(count($comments) > 0)
    <h1>Comments</h1>


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

       @foreach($comments as $comment)

       <tr>
            <td>{{$comment->id}}</td>
            <td>{{$comment->author}}</td>
            <td>{{$comment->email}}</td>
           <td>{{str_limit($comment->body, 30)}}</td>
           <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a></td>{{--$comment->post_id will also work--}}
           <td><a href="{{route('replies.show',$comment->id)}}">View Reply</a></td>{{-- view repl belonging to certain comment. admin/comment/replies/{reply} is uri for replies.show.--}}

         <td>

             {{--un-approve and approve comments--}}
                 {{--if comments are inactive approve button appears on side, if comments are active un-approve button appears--}}

                @if($comment->is_active == 1) {{--if comment is active, set it to 0(which is not active) in value in input type hidden--}}
                {!! Form::open(['method'=>'PUT', 'action'=>['PostCommentsController@update', $comment->id]]) !!}  <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

                        <input type="hidden" name="is_active" value="0">{{--means if comment is active change value to 0(inactive)- when unapprove button clicked--}}

                        {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}
                    </div>


                    {!! Form::close() !!}

                 @else {{--if not active(1), create a button to make it active--}}
                    {!! Form::open(['method'=>'PUT', 'action'=>['PostCommentsController@update', $comment->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

                        <input type="hidden" name="is_active" value="1">{{----}}

                        {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                        </div>


                        {!! Form::close() !!}
                 @endif

         </td>

        <td>
        {{--add delete button--}}

        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy',$comment->id]]) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->



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
        <h1 class="text-center">No Comments</h1>
@endif

@stop