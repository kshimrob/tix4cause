<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\PostCategory;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = BlogPost::where('status', 'PUBLISHED')->orderby('published_on', 'DESC')->paginate(8);
        $total_pages = $posts->lastPage();
        $categories = PostCategory::all();

        if ($request->ajax()) {
            $view = view('data2', compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('/blog')->with([
            'posts' => $posts,
            'categories' => $categories,
            'total_pages' => $total_pages
        ]);
    }
}
