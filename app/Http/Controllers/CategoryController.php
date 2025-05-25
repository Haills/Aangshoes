<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:categories', 'max:255']
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name'])
        ]);

        return to_route('categories.index')->withSuccess('Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($category->id)
            ]
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name'])
        ]);

        return to_route('categories.index')->withSuccess('Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('categories.index')->withSuccess('Category deleted successfully');
    }
}