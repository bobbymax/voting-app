<?php

namespace App\Http\Controllers;

use App\Models\Eligibility;
use App\Models\Category;
use App\Models\GradeLevel;
use Illuminate\Http\Request;

class EligibilityController extends Controller
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
        $eligibilities = Eligibility::latest()->get();
        return view('pages.eligibilities.index', compact('eligibilities'));
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
        return view('pages.eligibilities.create', compact('categories', 'gradeLevels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());

        $this->validate($request, [
            'category_id' => 'required|integer',
            'grades' => 'required|array'
        ]);

        foreach ($request->grades as $value) {
            $grade = GradeLevel::find($value);

            if ($grade) {
                $eligibility = Eligibility::create([
                    'category_id' => $request->category_id,
                    'grade_level_id' => $grade->id
                ]);
            }
        }

        return redirect()->route('eligibilities.index')->withStatus('Eligibilities created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function show(Eligibility $eligibility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function edit(Eligibility $eligibility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eligibility $eligibility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eligibility $eligibility)
    {
        //
    }
}
