<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\ArticleCreated;
use App\Events\ArticleUpdated;
use App\Events\ArticleDeleted;

class ArticleController extends Controller
{
    public function index()
    {
        // Retrieve all articles
        $articles = Article::paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        // Make sure the user has the 'create-article' permission
        if (!Auth::user()->can('create-article')) {
            abort(403, 'Unauthorized action.');
        }

        return view('articles.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the article
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = Auth::user()->id; // Associate the article with the currently logged-in user
        $article->save();

        event(new ArticleCreated($article));

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        // Make sure the user has the 'edit-article' permission
        if (!Auth::user()->can('edit-article')) {
            abort(403, 'Unauthorized action.');
        }

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the article
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->save();

        event(new ArticleUpdated($article));

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Make sure the user has the 'delete-article' permission
        if (!Auth::user()->can('delete-article')) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the article
        $article->delete();

        event(new ArticleDeleted($article));

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhereHas('categories', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->orWhereHas('tags', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->get();

        return view('articles.index', compact('articles'));
    }

}
