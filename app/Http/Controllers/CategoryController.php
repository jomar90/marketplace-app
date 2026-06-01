<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            ...$request->validated(),
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('status', 'category-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('status', 'category-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'category-deleted');
    }
}
