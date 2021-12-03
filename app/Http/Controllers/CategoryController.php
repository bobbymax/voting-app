<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        $categories = Category::latest()->get();
        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categories.create');
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
        ]);

        $category = Category::create([
            'name' => $request->name,
            'label' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->withStatus('Category created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $criterias = Criteria::latest()->get();
        return view('pages.categories.edit', compact('category', 'criterias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'criterias' => 'required|array'
        ]);

        $category->update([
            'name' => $request->name,
            'label' => Str::slug($request->name),
        ]);

        foreach ($request->criterias as $value) {
            $criteria = Criteria::find($value);

            if ($criteria) {
                if (! $category->hasCriteria($criteria->label)) {
                    $category->criterias()->save($criteria);
                }
            }
        }

        return redirect()->route('categories.index')->withStatus('Category updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->withStatus('Category deleted successfully!!');
    }
}
