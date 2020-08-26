<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
      'file',
    ];

    protected $directory = '/images/'; //created to be used in accessor below


    //Accessor for photo.
    public function getFileAttribute($photo){ //File is name of field
        return $this->directory . $photo;
    }



}
