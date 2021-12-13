<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Vote;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function fetchCastedVotes()
    {
        $staff = User::where('voted', 1)->orderBy('name')->get();
        return view('analysis', compact('staff'));

        // $votes = Vote::latest()->get();
        // return view('analysis', compact('votes'));
    }
}
