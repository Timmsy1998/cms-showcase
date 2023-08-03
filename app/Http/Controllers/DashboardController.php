<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve user's activities, ordered by the most recent first
        $activities = Activity::where('user_id', $user->id)->latest()->get();

        $articles = $user->articles;
        $categories = $user->categories;
        $tags = $user->tags;

        return view('dashboard', compact('user', 'activities'));
    }
}
