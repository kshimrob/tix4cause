<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;

class PostController extends Controller
{
    public function show($slug) 
    {
        $post = BlogPost::where('slug', '=', $slug)->firstOrFail();
	    return view('post', compact('post'));
    }
}
