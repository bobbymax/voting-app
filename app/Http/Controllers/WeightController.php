<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use App\Models\Category;
use App\Models\Criteria;
use Illuminate\Http\Request;

class WeightController extends Controller
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
        $weights = Weight::latest()->get();
        return view('pages.weights.index', compact('weights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $criterias = Criteria::latest()->get();
        return view('pages.weights.create', compact('categories', 'criterias'));
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
            'criteria_id' => 'required|integer',
            'value' => 'required|integer',
        ]);

        $weight = Weight::create([
            'category_id' => $request->category_id,
            'criteria_id' => $request->criteria_id,
            'value' => $request->value,
        ]);

        return redirect()->route('weights.index')->withStatus('Weight created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function show(Weight $weight)
    {
        return view('pages.weights.show', compact('weight'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function edit(Weight $weight)
    {
        $categories = Category::latest()->get();
        $criterias = Criteria::latest()->get();
        return view('pages.weights.edit', compact('weight', 'categories', 'criterias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weight $weight)
    {
        $this->validate($request, [
            'category_id' => 'required|integer',
            'criteria_id' => 'required|integer',
            'value' => 'required|string',
        ]);

        $weight->update([
            'category_id' => $request->category_id,
            'criteria_id' => $request->criteria_id,
            'value' => $request->value,
        ]);

        return redirect()->route('weights.index')->withStatus('Weight updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weight $weight)
    {
        $weight->delete();
        return back()->withStatus('Weight deleted successfully!!');
    }
}
