<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts   = Post::published()->featured()->orderBy('published_at', 'desc')->limit(5)->get();
        $trendingPosts   = Post::published()->orderBy('view_count', 'desc')->limit(6)->get();
        $latestPosts     = Post::published()->orderBy('published_at', 'desc')->limit(9)->get();
        $categories      = Category::where('is_active', true)->orderBy('post_count', 'desc')->limit(8)->get();
        $heroPost        = Post::published()->featured()->orderBy('published_at', 'desc')->first();

        return view('frontend.home', compact(
            'featuredPosts', 'trendingPosts', 'latestPosts', 'categories', 'heroPost'
        ));
    }
}
