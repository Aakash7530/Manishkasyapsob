<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Comment;
use App\Models\Newsletter;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts'      => Post::count(),
            'published_posts'  => Post::where('status', 'published')->count(),
            'draft_posts'      => Post::where('status', 'draft')->count(),
            'total_categories' => Category::count(),
            'total_contacts'   => Contact::count(),
            'unread_contacts'  => Contact::where('status', 'unread')->count(),
            'total_comments'   => Comment::count(),
            'pending_comments' => Comment::where('status', 'pending')->count(),
            'subscribers'      => Newsletter::where('status', 'active')->count(),
            'total_views'      => Post::sum('view_count') ?? 0,
        ];

        $recentPosts    = Post::orderBy('created_at', 'desc')->limit(5)->get();
        $recentContacts = Contact::orderBy('created_at', 'desc')->limit(5)->get();
        $topPosts       = Post::orderBy('view_count', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentContacts', 'topPosts'));
    }
}
