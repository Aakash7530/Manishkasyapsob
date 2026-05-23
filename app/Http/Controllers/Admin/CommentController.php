<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $comment->update(['status' => $request->status]);
        return back()->with('success', 'Comment status updated.');
    }

    public function destroy(string $id)
    {
        Comment::findOrFail($id)->delete();
        return back()->with('success', 'Comment deleted.');
    }
}
