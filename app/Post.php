<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    use Sluggable; //apluginn called sluggable that makes pretty urls

    protected $sluggable = [
      'build_from' => 'title', //grab titl save to slug column
      'save_to' => 'slug',
      'on_update' =>true
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'photo_id',
        'title',
        'body'
    ];

    public function user(){
        return $this->belongsTo('App\User'); //post has one user. means post table has user_id
    }

    public function photo(){
        return $this->belongsTo('App\Photo'); //post has one photo, means post table has photo_id
    }

    public function category(){
        return $this->belongsTo('App\Category'); //post has one category, , means post table has category_id
    }

    //post has a lot of comments
    public function comments(){
        return $this->hasMany('App\Comment');// means in comments table thre is post_id
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     * Used for pretty url
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
