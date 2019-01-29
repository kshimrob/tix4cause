<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostCategory;
use App\BlogPost;

class PostCategoryController extends Controller
{
    public function show($slug) {
        // match slug to category and get all the posts
        $category = PostCategory::where('slug', '=', $slug)->firstOrFail();
        $categories = PostCategory::all();
        $posts = $category->posts()->paginate(8);
        $total_pages = $posts->lastPage();

        // return the posts
        return view('postcategory')->with([
            'posts' => $posts,
            'category' => $category,
            'categories' => $categories,
            'total_pages' => $total_pages,
        ]);
        
    }
}
