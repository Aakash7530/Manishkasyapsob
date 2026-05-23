<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:300',
            'excerpt'          => 'required|string|max:1000',
            'category_id'      => 'nullable|string',
            'tags'             => 'nullable|string',
            'status'           => 'required|in:draft,published',
            'is_featured'      => 'nullable|boolean',
            'featured_image'   => 'nullable|image|max:5120',
            'image_url'        => 'nullable|url',
            'meta_title'       => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords'    => 'nullable|string|max:300',
        ]);

        $slug = Post::generateSlug($validated['title']);
        $featuredImage = null;
        $imageUrl = null;

        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image')->store('posts', 'public');
        } elseif ($request->filled('image_url')) {
            $imageUrl = $request->image_url;
        }

        $category = $validated['category_id'] ? Category::find($validated['category_id']) : null;
        $tags = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        $wordCount = str_word_count(strip_tags($validated['excerpt']));
        $readingTime = max(1, (int) ceil($wordCount / 200));

        Post::create([
            'title'            => $validated['title'],
            'slug'             => $slug,
            'excerpt'          => $validated['excerpt'],
            'content'          => $validated['excerpt'],
            'featured_image'   => $featuredImage,
            'image_url'        => $imageUrl,
            'category_id'      => $validated['category_id'] ?? null,
            'category_name'    => $category?->name,
            'tags'             => $tags,
            'author_id'        => auth()->id(),
            'author_name'      => auth()->user()->name,
            'status'           => $validated['status'],
            'is_featured'      => $request->boolean('is_featured'),
            'view_count'       => 0,
            'reading_time'     => $readingTime,
            'meta_title'       => $validated['meta_title'] ?? $validated['title'],
            'meta_description' => $validated['meta_description'] ?? Str::limit(strip_tags($validated['excerpt']), 160),
            'meta_keywords'    => $validated['meta_keywords'] ?? '',
            'published_at'     => $validated['status'] === 'published' ? now() : null,
            'comments_enabled' => true,
        ]);

        if ($category) {
            $category->increment('post_count');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(string $id)
    {
        $post       = Post::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title'            => 'required|string|max:300',
            'excerpt'          => 'required|string|max:1000',
            'category_id'      => 'nullable|string',
            'tags'             => 'nullable|string',
            'status'           => 'required|in:draft,published',
            'is_featured'      => 'nullable|boolean',
            'featured_image'   => 'nullable|image|max:5120',
            'image_url'        => 'nullable|url',
            'meta_title'       => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords'    => 'nullable|string|max:300',
        ]);

        $featuredImage = $post->featured_image;
        $imageUrl = $post->image_url;

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image && !filter_var($post->featured_image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $featuredImage = $request->file('featured_image')->store('posts', 'public');
            $imageUrl = null;
        } elseif ($request->filled('image_url')) {
            if ($post->featured_image && !filter_var($post->featured_image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $imageUrl = $request->image_url;
            $featuredImage = null;
        }

        $category = $validated['category_id'] ? Category::find($validated['category_id']) : null;
        $tags = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        $wordCount   = str_word_count(strip_tags($validated['excerpt']));
        $readingTime = max(1, (int) ceil($wordCount / 200));

        $post->update([
            'title'            => $validated['title'],
            'excerpt'          => $validated['excerpt'],
            'content'          => $validated['excerpt'],
            'featured_image'   => $featuredImage,
            'image_url'        => $imageUrl,
            'category_id'      => $validated['category_id'] ?? null,
            'category_name'    => $category?->name,
            'tags'             => $tags,
            'status'           => $validated['status'],
            'is_featured'      => $request->boolean('is_featured'),
            'reading_time'     => $readingTime,
            'meta_title'       => $validated['meta_title'] ?? $validated['title'],
            'meta_description' => $validated['meta_description'] ?? '',
            'meta_keywords'    => $validated['meta_keywords'] ?? '',
            'published_at'     => $validated['status'] === 'published' ? ($post->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}
