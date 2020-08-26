<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }


    public function isAdmin()
    { //method will be used in our middleware Admin.php

        // the user is an administrator and can perform admin functions only if his role is adminisrator and status is_active.
        if($this->role->name == "Administrator" && $this->is_active == 1) { //we can use role as a property (role->name) because its method is in same page above. if not we would have used it as a method (role())

            return true;
        }

        return false;


    } // go to  middleware Admin. check for logged in user. if user is logged in (Authorized) (isAdmn() method comes in)

    public function posts(){
        return $this->hasMany('App\Post');
    }

    //accessor for gravator,by doing this you are adding an accessing a column that does  ot exist in your dbase. column for gravatar

    public function getGravatarAttribute(){
        $hash = md5(strtolower(trim($this->attributes['email'])));//attributes is a function that get attributes, coulld asobe $this->>email
        return "http://www.gravatar.com/avatar/$hash";
    }
}
