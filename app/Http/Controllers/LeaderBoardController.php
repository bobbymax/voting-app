<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\User;
use App\Models\Category;

class LeaderBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function collateVotes()
    {
        // 1. Load all categories...
        // 2. 

        $nominees = User::orderBy('name')->get();
        $categories = Category::oldest()->get();

        return view('pages.leaderboard', compact('nominees', 'categories'));
    }
}
