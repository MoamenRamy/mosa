<?php

namespace App\Http\Controllers;

use App\Models\Order_item;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public $orderItem;

    public function __construct(Order_item $orderItem)
    {
        $this->orderItem = $orderItem;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItems = $this->orderItem::paginate(12);
        return view('order_items.index', compact('orderItems'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('order_items.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'order_id' => 'required',
    //         'goods_id' => 'required',
    //         'price' => 'required',
    //         'count' => 'required',
    //     ]);

    //     $orderItem = new $this->orderItem;

    //     $orderItem->order_id = $request->order_id;
    //     $orderItem->goods_id = $request->goods_id;
    //     $orderItem->price = $request->price;
    //     $orderItem->count = $request->count;
    //     $orderItem->save();

    //     // add flach section
    //     return redirect()->route('order_items.index');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Order_item $order_item)
    // {
    //     return view('order_items.show', compact('order_item'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Order_item $order_item)
    // {
    //     return view('order_items.edit', compact('order_item'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Order_item $order_item)
    // {
    //     $request->validate([
    //         'order_id' => 'required',
    //         'goods_id' => 'required',
    //         'price' => 'required',
    //         'count' => 'required',
    //     ]);

    //     $order_item->order_id = $request->order_id;
    //     $order_item->goods_id = $request->goods_id;
    //     $order_item->price = $request->price;
    //     $order_item->count = $request->count;

    //     $order_item->save();
    //     // add flach section
    //     return redirect()->route('order_items.index');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Order_item $order_item)
    // {
    //     $order_item->delete();
    //     return redirect()->route('order_items.index');
    // }
}
