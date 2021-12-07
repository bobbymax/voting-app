<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Zonal;
use App\Models\Weight;
use App\Models\Category;
use App\Models\User;
use App\Models\Criteria;
use Illuminate\Http\Request;

class VoteController extends Controller
{

    protected $category, $nominee, $vote;
    protected $alls = [];

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
        $this->validate($request, [
            'fields' => 'required|array'
        ]);

        foreach ($request->fields as $key => $data) {

            foreach ($data as $key => $value) {
                $this->category = $key !== 'category' ? Category::where('label', $key)->first() : null;

                if ($key !== 'category' && $this->category != null) {
                    $nominee1 = $this->getVotableEntity($this->category->group, $value['nominee1']);
                    $nominee2 = $this->getVotableEntity($this->category->group, $value['nominee2']);
                    $nominee3 = $this->getVotableEntity($this->category->group, $value['nominee3']);
                    $nominee4 = $this->getVotableEntity($this->category->group, $value['nominee4']);
                    $nominee5 = $this->getVotableEntity($this->category->group, $value['nominee5']);
                    $criteria1 = Criteria::where('label', $value['criteria1'])->first();
                    $criteria2 = Criteria::where('label', $value['criteria2'])->first();
                    $criteria3 = Criteria::where('label', $value['criteria3'])->first();
                    $criteria4 = Criteria::where('label', $value['criteria4'])->first();
                    $criteria5 = Criteria::where('label', $value['criteria5'])->first();

                    $entry1 = $this->saveVoteEntry($nominee1, $criteria1, $this->category);
                    $entry2 = $this->saveVoteEntry($nominee2, $criteria2, $this->category);
                    $entry3 = $this->saveVoteEntry($nominee3, $criteria3, $this->category);
                    $entry4 = $this->saveVoteEntry($nominee4, $criteria4, $this->category);
                    $entry5 = $this->saveVoteEntry($nominee5, $criteria5, $this->category);
                }
            }

            $this->alls[] = compact('nominee1', 'nominee2', 'nominee3', 'nominee4', 'nominee5');

        }

        // dd($this->alls);

        auth()->user()->voted = true;
        auth()->user()->save();

        return redirect()->route('home')->withStatus('Your Vote has been registered successfully!!');
    }

    protected function getVotableEntity($group, $id)
    {
        switch ($group) {
            case "zonal":
                return Zonal::find($id);
                break;
            
            default:
                return User::find($id);
                break;
        }
    }

    protected function saveVoteEntry($nominee, $criteria, $category)
    {
        $weight = Weight::where('category_id', $category->id)->where('criteria_id', $criteria->id)->first();

        if ($weight) {
            $this->vote = new Vote;

            $this->vote->category_id = $category->id;
            $this->vote->criteria_id = $criteria->id;
            $this->vote->user_id = auth()->user()->id;
            $this->vote->weight = $weight->value;

            $nominee->votes()->save($this->vote);
        }

        return $this->vote;
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
