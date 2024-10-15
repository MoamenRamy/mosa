<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Supplier_order_item;
use Carbon\Carbon;
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
    // public function index()
    // {
    //     $supplier_order_items = $this->supplier_order_item::paginate(12);
    //     return view('supplier_order_items.index', compact('supplier_order_items'));
    // }

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
    public function updateCount(Request $request, $id)
{
    $supplierOrderItem = $this->supplier_order_item::findOrFail($id);

    // Validate the input
    $request->validate([
        'count' => 'required|integer|min:1',
    ]);
    if($supplierOrderItem->goods) {
        $good = Goods::findOrFail($supplierOrderItem->goods_id);
        $good->count = $good->count + ($request->count - $supplierOrderItem->count);
        $good->save();
    }
    $numOfChange = $request->count - $supplierOrderItem->count;

    // Update the count field
    $supplierOrderItem->count = $request->count;
    $supplierOrderItem->total = $request->count * $supplierOrderItem->price;
    $supplierOrderItem->update();

    $order = $supplierOrderItem->supplier_order; // Get the associated order
    $order->price = $order->supplier_order_items->sum('total'); // Calculate the total price for all order items
    $supplierOrderItem->supplier_order->updated_at = Carbon::now();
    $supplierOrderItem->supplier_order->user_id = auth()->user()->id;
    $supplierOrderItem->supplier_order->save();

    if ($order->supplier)
    {
        $supplier = $order->supplier;
        $supplier->debt += ($numOfChange * $supplierOrderItem->price);
        $supplier->save();
    }


    // Return a JSON response
    return response()->json(['success' => true, 'message' => 'Count updated successfully']);
}

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Supplier_order_item $supplier_order_item)
    // {
    //     $supplier_order_item->delete();
    //     return redirect()->route('supplier_order_items.index');
    // }
}
