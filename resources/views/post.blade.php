@extends('layouts.blog-post')


@section('content')



    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? $post->photo->file : 'No Photo'}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{!! $post->body !!}</p> {{--after adding image intervention too ckeditor, {{$post->body}} changed to {{!! post->body !!}} --}} <!--because if left as before it will display the image source tags instead of image itself-->
    <br>    <br>
    <!-- Blog Comments -->

    <!-- Comments Form -->

    <!--commented out because we are going to use the discuss system plugin, that will bring in our comments with ther email name and image. see below-->
{{--@if(Auth::check()) --}}{{--only see form if you are logged in--}}
{{--    <div class="well">--}}

{{--        @if(session()->has('comment'))--}}

{{--            {{session('comment')}}--}}

{{--        @endif--}}

{{--        <h4>Leave a Comment:</h4>--}}

{{--        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->--}}

{{--        <input type="hidden" name="post_id" value="{{$post->id}}"> --}}{{--post_id is column name in comments.this will relate comment to post. that is commentswill belong to a certain post id--}}

{{--        <div class="form-group">--}}

{{--            {!! Form::label('body', 'Comment') !!}--}}
{{--            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=> 3]) !!}--}}


{{--        </div>--}}



{{--        <div class="form-group">--}}

{{--            {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}--}}
{{--        </div>--}}


{{--        {!! Form::close() !!}--}}
{{--    </div>--}}
{{--@endif--}}
{{--    <hr>--}}

{{--    <!-- Posted Comments -->--}}

{{--    <!-- Comment -->--}}
{{--    --}}{{--show comment if commens greater thanzero--}}
{{--    @if(count($comments)  > 0)--}}
{{--        @foreach($comments as $comment)--}}
{{--    <div class="media">--}}
{{--        <a class="pull-left" href="#"><img class="media-object" src="{{Auth::user()->gravatar}}" width="64" alt=""><!--was --}}{{--$comment->photo--}}{{--.now pulling gravatar instead of photo from dbase. gravatar set as accessor in user model-->--}}
{{--        </a>--}}
{{--        <div class="media-body">--}}
{{--            <h4 class="media-heading">{{$comment->author}}--}}
{{--                <small>{{$comment->created_at->diffForHumans()}}</small>--}}
{{--            </h4>--}}
{{--            {{$comment->body}}--}}

{{--            @if(count($comment->replies) > 0) <!--only show replies when they exist-->--}}
{{--                @foreach($comment->replies as $reply)--}}
{{--                    @if($reply->is_active == 1)--}}
{{--        <!-- Nested Comment -->--}}

{{--            <div id="nested-comment" class="media">--}}

{{--                <a class="pull-left" href="#">--}}
{{--                    <img class="media-object" src="{{$reply->photo}}" alt=""width="64">--}}
{{--                </a>--}}
{{--                <div class="media-body">--}}
{{--                    <h4 class="media-heading  ">{{$reply->author}}--}}
{{--                        <small>{{$reply->created_at->diffForHumans()}}</small>--}}
{{--                    </h4>--}}
{{--                    {{$reply->body}}--}}
{{--                </div>--}}

{{--                <div class="comment-reply-container">--}}
{{--                    <button class="toggle-reply btn btn-primary pull-right mb-3">Reply</button>--}}

{{--                    <div class="comment-reply col-sm-6">--}}{{--we will hide form. form willonly be displayed when one clicks reply button--}}
{{--                    <!--create -->--}}
{{--                            {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->--}}

{{--                                <input type="hidden" name="comment_id" value="{{$comment->id}}">--}}{{--comment_id is column in commnt replies. means comment_id = id in commnes table.this will relate reply to comment repplies to commentss. that is commentswill belong to a certain post id--}}

{{--                                <div class="form-group">--}}
{{--                                    {!! Form::label('body', 'Body') !!}--}}
{{--                                    {!! Form::textarea('body', null, ['class'=>'form-control', "rows" => 1]) !!}--}}

{{--                                </div>--}}
{{--                                <div class="form-group">--}}

{{--                                    {!! Form::submit('Submit', ['class'=>'btn btn-info']) !!}--}}
{{--                                </div>--}}


{{--                                {!! Form::close() !!}--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            <!-- End Nested Comment -->--}}

{{--        </div>--}}
{{--                        @else--}}
{{--                        <h1 class="text-center">No replies</h1>--}}
{{--        @endif--}}
{{--        @endforeach--}}
{{--                @endif--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    @endforeach--}}
{{--        @endif--}}
{{--    <!-- Comment -->--}}
{{--    <div class="media">--}}
{{--        <a class="pull-left" href="#">--}}
{{--            <img class="media-object" src="http://placehold.it/64x64" alt="">--}}
{{--        </a>--}}
{{--        <div class="media-body">--}}
{{--            <h4 class="media-heading">Start Bootstrap--}}
{{--                <small>August 25, 2014 at 9:30 PM</small>--}}
{{--            </h4>--}}
{{--            --}}
{{--        </div>--}}
{{--    </div>--}}

{{--@section('scripts')--}}

{{--    <script>--}}
{{--      const reply =   document.querySelector('.toggle-reply').addEventListener('click',function(e){--}}

{{--          setTimeout(function(){--}}
{{--              document.querySelector('.comment-reply').style.display = 'block';--}}
{{--          }, 500);--}}











{{--          e.preventDefault();--}}
{{--      });--}}




{{--    </script>--}}

{{--@endsection--}}


    <div id="disqus_thread"></div>
    <script>

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://http-codehacking-localhost.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <script id="dsq-count-scr" src="//http-codehacking-localhost.disqus.com/count.js" async></script>



@stop