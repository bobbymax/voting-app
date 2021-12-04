<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\GradeLevelImport;
use App\Imports\UserImport;
use App\Imports\CategoryImport;

class ImportController extends Controller
{
    public function index()
    {
        return view('imports');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'entity' => 'required|string',
            'file' => 'required'
        ]);

        $file = $request->file('file')->store('import');

        switch ($request->entity) {
            case "grades":
                (new GradeLevelImport())->import($file);
                break;
            case "users":
                (new UserImport())->import($file);
                break;
            case "categories":
                (new CategoryImport())->import($file);
                break;
            default:
                [];
                break;
        }

        return back()->withStatus('File uploaded successfully!!');
    }
}
