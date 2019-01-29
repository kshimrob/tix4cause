<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PostCategory extends Model
{
    public function posts() 
    {
      return $this->belongsToMany('App\BlogPost', 'blogpost_category');
    }
}
