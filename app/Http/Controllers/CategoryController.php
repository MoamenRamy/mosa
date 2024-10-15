<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());

        $query = Category::query();  // Adjust this based on how you are querying categories

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $category = $query->paginate(12);

        // If the request is an AJAX request, return the partial view
        if ($request->ajax()) {
            return view('category.partials.category_list', compact('category'))->render();
        }

        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new $this->category;

        $category->name = $request->name;

        $category->save();

        // session flash

        return redirect()->route('category.index')->with('success', 'تم إضافة التصنيف بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     // we will remove this function
    //     $category = $this->category::findOrFail($id);
    //     return view('category.show', compact('category'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $this->category::findOrFail($id);
        // $category->update($request->all());
        $category->name = $request->name;

        $category->update();

        //session flash

        return redirect()->route('category.index')->with('success', 'تم تعديل التصنيف بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        // session flash

        return redirect()->route('category.index')->with('success', 'تم مسح التصنيف بنجاح!');
    }
}
