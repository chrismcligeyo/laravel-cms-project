<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Object_;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //comment form has only the body section. comments table has auhor, email, is_active.etc how will we send all that info to database if form content has only the body section and not these other fields?
        //answer. we could create fields for it but we want comment section to have body only. We will pull out info from the logged in user and some from the request

        $user = Auth::user(); //pull only logged in user

        //creae array of data commnt is going to have

         $data = [
//left is table column names right is
        'post_id' => $request->post_id,
             // add this<input type="hidden" name="post_id value="{{$post->id}}"> to form for comment.Comments will belong to a certain post id
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->file,
            'body' => $request->body

    ];

        Comment::create($data); //if we create request all it will request the body and post-id fields in comment section only. create the date array. will create comment related to post_id.Will also create it with the username, email, photo
//        return $request->all();

        //include flash message toshow comment submitted

        session()->flash('comment', 'Comment submitted awaiting approval ');
        return redirect()->back(); //redirects it to same page

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $post = Post::findOrFail($id);//find post
        $comments = $post->comments;//pull comments belonging to post

        return view('admin.comments.show',compact('comments'));
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

        Comment::findOrFail($id)->update($input);

        return redirect('admin/comments');
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

        Comment::findOrFail($id)->delete();
        return redirect()->back();

    }
}
