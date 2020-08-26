<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected  $fillable = [

         'post_id',
         'is_active',
         'author',
         'email',
         'body',
        'photo'

    ];

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function replies(){
        return $this->hasMany('App\CommentReply'); //comment has many replies
    }
}
