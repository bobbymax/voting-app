<?php

namespace App\Http\Controllers;

use App\Models\CanVote;
use App\Models\Category;
use App\Models\GradeLevel;
use Illuminate\Http\Request;

class CanVoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $canVotes = CanVote::latest()->get();
        return view('pages.canVotes.index', compact('canVotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $gradeLevels = GradeLevel::latest()->get();
        return view('pages.canVotes.create', compact('categories', 'gradeLevels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'category_id' => 'required|integer',
            'grades' => 'required|array'
        ]);

        foreach ($request->grades as $value) {
            $grade = GradeLevel::find($value);

            if ($grade) {
                $canVote = CanVote::create([
                    'category_id' => $request->category_id,
                    'grade_level_id' => $grade->id
                ]);
            }
        }

        return redirect()->route('canVotes.index')->withStatus('Votables created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CanVote  $canVote
     * @return \Illuminate\Http\Response
     */
    public function show(CanVote $canVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CanVote  $canVote
     * @return \Illuminate\Http\Response
     */
    public function edit(CanVote $canVote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CanVote  $canVote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CanVote $canVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CanVote  $canVote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanVote $canVote)
    {
        //
    }
}
