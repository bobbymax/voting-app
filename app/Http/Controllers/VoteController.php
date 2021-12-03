<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Entry;
use App\Models\Weight;
use App\Models\Category;
use App\Models\User;
use App\Models\Criteria;
use Illuminate\Http\Request;

class VoteController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'fields' => 'required|array'
        ]);

        foreach ($request->fields as $value) {
            
            $category = Category::find($value['categories']);
            $nominee = User::find($value['nominees']);

            if ($category && $nominee) {
                $vote = Vote::create([
                    'user_id' => auth()->user()->id,
                    'nominee_id' => $nominee->id,
                    'category_id' => $category->id,
                    'total' => 0
                ]);

                if ($vote) {
                    foreach($value['criterias'] as $nomb) {
                        $criteria = Criteria::find($nomb);

                        if ($criteria) {
                            $weight = Weight::where('category_id', $category->id)->where('criteria_id', $criteria->id)->first();

                            if ($weight) {
                                $entry = Entry::create([
                                    'vote_id' => $vote->id,
                                    'criteria_id' => $criteria->id,
                                    'weight' => $weight->value
                                ]);

                                $vote->total = $vote->entries->sum('weight');
                                $vote->save();
                            }
                        }
                    }

                    auth()->user()->voted = true;
                    auth()->user()->save();
                }
            }
        }

        return back()->withStatus('Your vote has been registered!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
