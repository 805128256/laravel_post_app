<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeling extends Model
{
    public function posts()
    {
        return $this->belongsTo('App\post');
    }
}
