<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $roles = Role::pluck('name', 'id')->all(); //lists used to get specific items. all brings it down. list has been depracated, use pluck
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request) //was Request previously. Turned to UsersRequest, we created a request UsersRequest. request used to not send form when empty. errors method enabled when validation used.
    {
        //persist user data in database
//        User::create($request->all()); //will send all data to database except file(photo )
//        return redirect('admin/users');



//        if($request->file('photo_id')) {//means if there is any file in photo id(input field) do below
//
//                return "Photo Exists";}


        if(trim($request->password == '')){ //if password input field is empty
            //trim removes whitespaces

            $request->except('password'); //pass all the fields except password




        } else {
            $input = $request->all();//pass all fields.columns
            //encrypt password
            $input['password'] = bcrypt($request->password);
        }

//        $input = $request->all();

        if ($file = $request->file('photo_id')) { //if there is a file in input field while submitting

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file' => $name]); // create a file in file column with time and name attribute.have a look at users/index. did not have to add url /images/ at src because of accessor cretaed here

            $input['photo_id'] = $photo->id; //photo_id  in users table assigned  to id in photos table

        }
//            //encrypt password
//            $input['password'] = bcrypt($request->password); //taken to password section above in if

            User::create($input);
            return redirect ('admin/users');


//


    }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function edit($id)
        {
            //
            $user = User::findOrFail($id);



            // you have to pull out the roles too. becausewill be added to select aray for roles

            $roles = Role::pluck('name','id')->all();

            return view('admin.users.edit',compact('user','roles'));

        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function update(UsersEditRequest $request, $id)
        {
            //
           $user = User::findOrFail($id);


            if(trim($request->password == '')){ //if password column is empty
                //trim removes whitespaces

                $input =$request->except('password'); //pass all the fields except password




            } else {
                $input = $request->all();//pass all fields.columns with password
                //encrypt password
                $input['password'] = bcrypt($request->password);
            }


//            $input = $request->all(); place in password if state above

            //check if file exists. request photo_id(input field) into file column

            if($file = $request->file('photo_id')){

                $name = time() . $file->getClientOriginalName();

                //move file to images folder in public with its name

                $file->move('images', $name);

                $photo = Photo::create(['file'=> $name]); //create photoin file column with a name

                $input['photo_id'] = $photo->id;

            }

            $user->update($input);

            return redirect('/admin/users');

        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
            $user = User::findOrFail($id);
            //we are deleting user but not images belonging to user in public direcory. use php method unlink() as shown below to delete user with image belonging to that user

            unlink(public_path() . $user->photo->file); //deletes images from public folder when post deleted in database. Remember post cmes with a photo. if we were not using an accessor for the photos in photo model it would have been written as unlink(public_path() . "/images" . $user->photo->file)
            $user->delete();

            //add a flash message after deleting.using sessions
            session()->flash('deleted_user','The user has been deleted');// key and message. key would be used in the user index to call session
            return redirect('/admin/users');

//            //method 2. you will have to import class support facades to top if you use this method
//            Session::flash('deleted_user', 'The user has been deleted');
//            return redirect('/admin/users');

            //you could also use $request->session()->put(['deleted_user','The user has been deleted']). but with this you will have to include (Request $request) in public function destroy($id).i.e public function destroy(Request $request $id)
        }
    }
