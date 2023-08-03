<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        // Retrieve all tags
        $tags = Tag::all();

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        // Make sure the user has the 'create-tag' permission
        if (!Auth::user()->can('create-tag')) {
            abort(403, 'Unauthorized action.');
        }

        return view('tags.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tags',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the tag
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->slug = \Str::slug($request->input('name'));
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        // Make sure the user has the 'edit-tag' permission
        if (!Auth::user()->can('edit-tag')) {
            abort(403, 'Unauthorized action.');
        }

        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the tag
        $tag->name = $request->input('name');
        $tag->slug = \Str::slug($request->input('name'));
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        // Make sure the user has the 'delete-tag' permission
        if (!Auth::user()->can('delete-tag')) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the tag
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
