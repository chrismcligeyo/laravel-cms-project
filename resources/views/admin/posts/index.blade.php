@extends('layouts.admin')

@section('content')

    <h1>Posts</h1>

    @if(Session::has('deleted_post')) {{--if session with key deleted post exists then display session.  --}}

        <p class="bg-danger">{{session('deleted_post')}}</p>


    @endif

    <table class="table table-striped">
        <thead>
          <tr>
            <th>Id</th>
              <th>Photo</th>
            <th>User</th>
            <th>Category</th>

              <th>Title</th>
              <th>Body</th>
              <th>Created</th>
              <th>Updated</th>
          </tr>
        </thead>
        <tbody>

              @if($posts)
                  @foreach($posts as $post)
                  <tr>
            <td>{{$post->id}}</td>
                      <td><img height="50" src="{{$post->photo ? $post->photo->file : '/images/placeholder1.png'}}" alt="">  </td>
                      <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a> </td>
            <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
              <td>{{$post->title}}</td>
              <td>{{str_limit($post->body, '30')}}</td> {{--check laravel helper functions in google, then go to strings in laravel. str_limit limits words in body to 30 characters--}}

              <td>{{$post->created_at->diffForhumans()}}</td>
              <td>{{$post->updated_at->diffForhumans()}}</td>
                      <td><a href="{{route('home.post', $post->id)}}">View Post</a></td> {{--was   <td><a href="{{route('home.post', $post->id)}}">View Post</a></td> after adding sluggable plugin, we will send slug instead of id --}}
                      <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
                  </tr>

              @endforeach
              @endif


        </tbody>
      </table>

    {{--pagination html--}}
    <div class="row">
        <div class="col-sm-6 col-sm-offset-4"><!--offset moves the div 4 spacesss-->
            {{$posts->render()}}
        </div>
    </div>



@endsection