<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
