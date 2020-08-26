<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Cviebrock\EloquentSluggable\Services\SlugService; //for prety urls


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $posts = Post::all();
          //to include paination wehave to limit display of pages. so instead os post::All.
        $posts = Post::paginate(2);  //go to post index, below table aan create html for pagination.  means show two posts in first page, then other 2  posts in the next page ----

        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request) //request creaed for validation
    {
        //return $request->all()

        $input = $request->all();

        $user = Auth::user(); //find authorized users, instead of finding all users User::find($id)

        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id; //photo id input name  = photo id columnin database
        }

        $user->posts()->create($input); //create posts belonging to certainuser

        return redirect('/admin/posts');

;    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $post = Post::findOrFail($id);
        $category = Category::pluck('name', 'id');
        return view('admin.posts.edit',compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        if($file = $request->file('photo_id')){//input filedfile name

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        Auth::user()->posts()->where('id', $id)->first()->update($input); //means find first post belonging to authorized usser and update it
        return redirect('/admin/posts');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);

        //unlink image. delete image from pun=blic folder when deleted from application

        unlink(public_path() . $post->photo->file);

        //delete


        $post->delete();

        //set flash message using sessions.if used as below you will have to import it
//        session()->flash('deleted_post','The post has been deleted');
//        return redirect('/admin/posts');

        Session::flash('deleted_post', 'The post has been deleted');
        return redirect('/admin/posts');
    }

    public function post($id) { //was previously $id before installing sluggable(prety url). sluggable did not work correctly
//        $slug = new SlugService();
        $post = Post::findOrFail($id); //was $post = Post::findOrFail($id)
//        $comments = $post->comments; //brings in all comments whether active or inactive
        ///want to display active commnts in the comment section
        $comments = $post->comments()->whereis_active(1)->get();

//        return $post;
        return view('post', compact('post','comments')); //view to post.blade.php
    }
}
