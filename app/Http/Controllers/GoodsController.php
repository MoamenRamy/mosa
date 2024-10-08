<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public $goods;

    public function __construct(Goods $goods)
    {
        $this->goods = $goods;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goods = $this->goods::with('category')->paginate(12);

        return view('goods.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('goods.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'count' => 'required',
        ]);

        $goods = new $this->goods;

        $goods->name = $request->name;
        $goods->price = $request->price;
        $goods->count = $request->count;
        $goods->category_id = $request->category_id;
        // $goods->supplier_id = $request->supplier_id;

        $goods->save();

        // add flach section
        return redirect()->route('goods.index')->with('success', 'تم إضافة البضاعة بنجاح!');
        // ->with('success', 'Товар добавлен успешно')
    }

    /**
     * Display the specified resource.
     */
    public function show(goods $goods)
    {
        return view('goods.show', compact('goods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $good = Goods::findOrFail($id); // Fetch the good by ID
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('goods.edit', compact('good', 'categories')); // Pass good and categories to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'count' => 'required',
        ]);
        $goods = $this->goods::findOrFail($id);

        $goods->name = $request->name;
        $goods->price = $request->price;
        $goods->count = $request->count;
        $goods->category_id = $request->category_id;
        // $goods->supplier_id = $request->supplier_id;

        $goods->update();

        // add flach section
        // return redirect()->route('goods.show', $goods);
        return redirect()->route('goods.index')->with('success', 'تم تعديل البضاعة بنجاح!');
        // ->with('success', 'Товар изменен успешно')
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $goods = Goods::find($id);


        $goods->delete(); // This deletes the record from the database

        return redirect()->route('goods.index')->with('success', 'تم مسح البضاعة بنجاح!');
        // ->with('success', 'Товар удален успешно')
    }
}
