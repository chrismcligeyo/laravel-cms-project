<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)

    {
        if(Auth::check()){//check if user is logged in. means if user logged in. whole if statement means if user logged in(authorized) is admin an

            if(Auth::user()->isAdmin()){ //if authorized user is admin. isAdmin() is method from User model which returns true if user is adminisrator and is active, false if not. means if user is administrator and designated as not active he/shewill not have admin rights
                return $next($request);//means everything went through, go to next step of application
            }


        }
            //if user not logged in redireced to a 404 page
//        return redirect(404); //create 404 page in resources/views/errors. can redirect to homepage('/')
        return redirect('/'); //redirect to haomepage
    }

    // Go to controllers Auth/LoginController.php, RegisterContr and ResetPassConroller and redirect to admin instead of lavarelhomepage if a user is admin and not active,when they login will be redirected to admin page
    // cant see my authcontroller
}
