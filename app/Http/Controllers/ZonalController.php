<?php

namespace App\Http\Controllers;

use App\Models\Zonal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ZonalController extends Controller
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
        $zonals = Zonal::all();
        return view('pages.zonals.index', compact('zonals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.zonals.create');
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
            'name' => 'required|string'
        ]);

        $zonal = Zonal::create([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return redirect()->route('zonals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zonal  $zonal
     * @return \Illuminate\Http\Response
     */
    public function show(Zonal $zonal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zonal  $zonal
     * @return \Illuminate\Http\Response
     */
    public function edit(Zonal $zonal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zonal  $zonal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zonal $zonal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zonal  $zonal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zonal $zonal)
    {
        //
    }
}
