<?php

namespace App\Http\Controllers;

use App\Models\Supplier_order_item;
use Illuminate\Http\Request;

class SupplierOrderItemController extends Controller
{

    public $supplier_order_item;

    public function __construct(Supplier_order_item $supplier_order_item)
    {
        $this->supplier_order_item = $supplier_order_item;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier_order_items = $this->supplier_order_item::paginate(12);
        return view('supplier_order_items.index', compact('supplier_order_items'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('supplier_order_items.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'supplier_order_id' => 'required',
    //         'goods_id' => 'required',
    //         'price' => 'required',
    //         'count' => 'required',
    //     ]);

    //     $supplier_order_item = new $this->supplier_order_item;

    //     $supplier_order_item->supplier_order_id = $request->supplier_order_id;
    //     $supplier_order_item->goods_id = $request->goods_id;
    //     $supplier_order_item->price = $request->price;
    //     $supplier_order_item->count = $request->count;

    //     $supplier_order_item->save();

    //     return redirect()->route('supplier_order_items.index');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Supplier_order_item $supplier_order_item)
    // {
    //     return view('supplier_order_items.show', compact('supplier_order_item'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Supplier_order_item $supplier_order_item)
    // {
    //     return view('supplier_order_items.edit', compact('supplier_order_item'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Supplier_order_item $supplier_order_item)
    // {
    //     $request->validate([
    //         'supplier_order_id' => 'required',
    //         'goods_id' => 'required',
    //         'price' => 'required',
    //         'count' => 'required',
    //         ]);

    //         $supplier_order_item->supplier_order_id = $request->supplier_order_id;
    //         $supplier_order_item->goods_id = $request->goods_id;
    //         $supplier_order_item->price = $request->price;
    //         $supplier_order_item->count = $request->count;

    //         $supplier_order_item->save();

    //         return redirect()->route('supplier_order_items.index');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Supplier_order_item $supplier_order_item)
    // {
    //     $supplier_order_item->delete();
    //     return redirect()->route('supplier_order_items.index');
    // }
}
