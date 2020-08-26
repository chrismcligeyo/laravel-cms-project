<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function createReply(Request $request) { //my own method

       $user =  Auth::user(); //authorized users

        $data = [
//left is table column names right is
            'comment_id' => $request->comment_id,
            // add this<input type="hidden" name="post_id value="{{$post->id}}"> to form for comment.Comments will belong to a certain post id
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->file,
            'body' => $request->body

        ];

        CommentReply::create($data); //if we create request all it will request the body and post-id fields in comment section only. create the date array. will create comment related to post_id.Will also create it with the username, email, photo
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

        //we want to show replies.
        //we find comment

        $comment = Comment::findOrFail($id);

        //find relationshinship
        $replies = $comment->replies;

        return view('admin.comments.replies.show',compact('replies'));

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
        CommentReply::findOrFail($id)->update($request->all());

        return redirect()->back();
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
        CommentReply::findOrFail($id)->delete();
        return redirect()->back();
    }
}
