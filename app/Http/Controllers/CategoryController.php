<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        // Retrieve all categories
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // Make sure the user has the 'create-category' permission
        if (!Auth::user()->can('create-category')) {
            abort(403, 'Unauthorized action.');
        }

        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the category
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = \Str::slug($request->input('name'));
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        // Make sure the user has the 'edit-category' permission
        if (!Auth::user()->can('edit-category')) {
            abort(403, 'Unauthorized action.');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the category
        $category->name = $request->input('name');
        $category->slug = \Str::slug($request->input('name'));
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Make sure the user has the 'delete-category' permission
        if (!Auth::user()->can('delete-category')) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
