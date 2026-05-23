<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->orderBy('published_at', 'desc');

        if ($request->filled('category')) {
            $query->where('category_name', $request->category);
        }
        if ($request->filled('tag')) {
            $query->where('tags', $request->tag);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts      = $query->paginate(9)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('post_count', 'desc')->get();
        $featured   = Post::published()->featured()->orderBy('published_at', 'desc')->limit(3)->get();

        return view('frontend.blog.index', compact('posts', 'categories', 'featured'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $post->incrementViews();

        $related = Post::published()
            ->where('_id', '!=', $post->_id)
            ->where('category_id', $post->category_id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $comments = $post->comments()->where('status', 'approved')->orderBy('created_at', 'desc')->get();

        return view('frontend.blog.show', compact('post', 'related', 'comments'));
    }

    public function storeComment(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            ...$validated,
            'post_id'    => $post->_id,
            'status'     => 'pending',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Your comment has been submitted and is awaiting moderation.');
    }

    public function byCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::published()->where('category_id', (string)$category->_id)
                     ->orderBy('published_at', 'desc')->paginate(9);
        $categories = Category::where('is_active', true)->get();

        return view('frontend.blog.category', compact('posts', 'category', 'categories'));
    }
}
