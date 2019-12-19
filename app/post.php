<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function feeling()
    {
        return $this->hasOne('App\Feeling');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
