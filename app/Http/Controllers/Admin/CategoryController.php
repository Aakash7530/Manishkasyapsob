<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:300',
            'color'       => 'nullable|string|max:20',
            'icon'        => 'nullable|string|max:50',
        ]);

        Category::create([
            ...$validated,
            'slug'      => Category::generateSlug($validated['name']),
            'is_active' => true,
            'post_count'=> 0,
        ]);

        return back()->with('success', 'Category created!');
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:300',
            'color'       => 'nullable|string|max:20',
            'icon'        => 'nullable|string|max:50',
            'is_active'   => 'nullable|boolean',
        ]);
        $category->update($validated);
        return back()->with('success', 'Category updated!');
    }

    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted!');
    }
}
