<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'grade_level_id' => 'required|integer',
        ]);

        auth()->user()->grade_level_id = $request->grade_level_id;
        auth()->user()->save();

        return back()->withStatus('Profile has been updated successfully');
    }
}
