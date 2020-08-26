@extends('layouts.admin')

@section('content')

<h1>Categories</h1>

@if(Session::has('deleted_category'))

    <p class="bg-danger">{{session('deleted_category')}}</p>

@endif

    <div class="row">
        <div class="col-sm-6">
            {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!} <!--files true enables you to add file, upload. equivalent of enctype=multiform/data-->

            <div class="form-group">

                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}


            </div>



            <div class="form-group">

                {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
            </div>


            {!! Form::close() !!}

        </div>

            <div class="col-sm-6">

                @if($categories)

                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                          <td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No Date'}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                    @endif
            </div>

    </div>




@stop