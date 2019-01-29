<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BlogPost extends Model
{
  public function categories() 
  {
      return $this->belongsToMany('App\PostCategory', 'blogpost_category');
  }
}
