@extends('layouts.admin')


@section('content')

    {{--Session first set in destroy at AdminUsersController.When we click delete button session set will display at top that user has been deleted --}}
{{--method 1. with this method you will have to import Session class at AdminUsersController@destroy where you use Session --}}
{{--@if(Session::has('deleted_user'))--}}
{{--    <p class="bg-danger">{{session('deleted_user')}}</p>--}}{{--class bg-danger makes background red--}}


{{--@endif--}}

{{--method 2. use this--}}
@if(session()->has('deleted_user'))

   <p class="bg-danger">{{session('deleted_user')}}</p>{{--class bg-danger makes background red--}}




    @endif

   <table class="table table-hover">
       <thead>
       <tr>
           <th>Id</th>
           <th>Photo</th>
           <th>Name</th>
           <th>Email</th>
           <th>Role</th>
           <th>Status</th>

           <th>Created Time</th>
           <th>Updated Time</th>
       </tr>
       </thead>
       <tbody>

       @if($users)

       @foreach($users as $user)

       <tr>
           <td>{{$user->id}}</td>
           <td><img height="50" src="{{$user->photo ? $user->photo->file : 'https://via.placeholder.com/400'}}" alt=""></td> {{--if user photo exist then display user photo file, if not display no photos found--}}
           <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>  {{--when you click on name redirestc you to page with individual clicked on name--}}
           <td>{{$user->email}}</td>
           <td>{{$user->role->name}}</td>
           <td>

{{--               @if($user->is_active === 1)--}}

{{--               Active--}}

{{--               @else--}}

{{--                Not active--}}
{{--               @endif--}}

               {{$user->is_active == 1 ? 'Active' : 'Not Active'}}


           </td>
           <td>{{$user->created_at->diffForHumans()}}</td>{{--diffForHumans is a Carbon method that shows time in human readable form--}}
           <td>{{$user->updated_at->diffForHumans()}}</td>
       </tr>

       @endforeach
        @endif
       </tbody>
   </table>

@stop