<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use Illuminate\Http\Request;

class GradeLevelController extends Controller
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
        $grades = GradeLevel::latest()->get();
        return view('pages.grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.grades.create');
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
            'name' => 'required|string',
            'key' => 'required|string|unique:grade_levels'
        ]);

        $grade = GradeLevel::create([
            'name' => $request->name,
            'key' => $request->key,
        ]);

        return redirect()->route('gradeLevels.index')->withStatus('Grade Level created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradeLevel  $gradeLevel
     * @return \Illuminate\Http\Response
     */
    public function show(GradeLevel $gradeLevel)
    {
        return view('pages.grades.show', compact('gradeLevel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradeLevel  $gradeLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(GradeLevel $gradeLevel)
    {
        return view('pages.grades.edit', compact('gradeLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradeLevel  $gradeLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradeLevel $gradeLevel)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'key' => 'required|string'
        ]);

        $gradeLevel->update([
            'name' => $request->name,
            'key' => $request->key,
        ]);

        return redirect()->route('gradeLevels.index')->withStatus('Grade Level updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradeLevel  $gradeLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeLevel $gradeLevel)
    {
        $gradeLevel->delete();
        return back()->withStatus('Grade Level updated successfully!!');
    }
}
