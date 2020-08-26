<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $photos = Photo::all();
        return view('admin.media.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dropzone uses name file as key for input

        $file = $request->file('file'); //file is key for input field in dropzone upload plugin

        $name = time() . $file->getClientOriginalName();

        $file->move('images',$name);

        Photo::create(['file'=>$name]); //file is name for column file
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
        $photos = Photo::findOrFail($id);

        unlink(public_path() . $photos->file);

        $photos->delete();

//        return redirect("/admin/media"); //this is same as below.
        return redirect(route('admin.media.index'));
    }

    public function deleteMedia(Request $request) {

//        $input = $request->input('checkBoxArray'); // can be $request->checkBoxArray

        $photos = Photo::whereKey($request->checkBoxArray)->get(); //if ou use find or fail it will return an error,because find return a boolean, is it there = true or false. Fatal error: Call to a member function delete() on bool


        foreach($photos as $photo) {

            $photo->delete();
        }

        return redirect()->back();
//        dd($request);

    }
}
