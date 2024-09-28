<?php

namespace App\Http\Controllers;

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
        $goods = $this->goods::paginate(12);
        return view('goods.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('goods.create');
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
        $goods->supplier_id = $request->supplier_id;

        $goods->save();

        // add flach section
        return redirect()->route('goods.index');
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
    public function edit(goods $goods)
    {
        return view('goods.edit', compact('goods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, goods $goods)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'count' => 'required',
        ]);

        $goods->name = $request->name;
        $goods->price = $request->price;
        $goods->count = $request->count;
        $goods->category_id = $request->category_id;
        $goods->supplier_id = $request->supplier_id;

        $goods->save();

        // add flach section
        return redirect()->route('goods.show', $goods);
        // ->with('success', 'Товар изменен успешно')
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(goods $goods)
    {
        $goods->delete();
        return redirect()->route('goods.index');
        // ->with('success', 'Товар удален успешно')
    }
}
