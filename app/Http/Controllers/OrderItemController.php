<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Order;
use App\Models\Order_item;
use Carbon\Carbon;
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
    public function updateCount(Request $request, $id)
{
    $orderItem = $this->orderItem::findOrFail($id);

    // Validate the input
    $request->validate([
        'count' => 'required|integer|min:1',
    ]);
    if($orderItem->goods) {
        $good = Goods::findOrFail($orderItem->goods_id);
        $good->count = $good->count - ($request->count - $orderItem->count);
        $good->save();
    }

    // Update the count field
    $orderItem->count = $request->count;
    $orderItem->total = $request->count * $orderItem->price;
    $orderItem->update();

    $order = $orderItem->order; // Get the associated order
    $order->price = $order->order_items->sum('total'); // Calculate the total price for all order items
    $orderItem->order->updated_at = Carbon::now();
    $orderItem->order->user_id = auth()->user()->id;
    $orderItem->order->save();


    // Return a JSON response
    return response()->json(['success' => true, 'message' => 'Count updated successfully']);
}

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($id)
    // {
    //     $order_item = $this->orderItem::find($id);
    //     $order_item->delete();

    //     $order = $order_item->order;

    //     $order->updated_at = Carbon::now();
    //     $order->user_id = auth()->user()->id;

    //     // Recalculate the total amount for the order
    //     $totalAmount = $order->orderItems->sum('total');
    //     // $order->update(['price' => $totalAmount]);
    //     $order->price - $totalAmount;

    //     $order->save();

    //     return redirect()->back();
    // }

    public function addItem(Request $request, $orderId)
{
    // Validate incoming request
    $request->validate([
        'goods_id' => 'required|exists:goods,id',
        'count' => 'required|numeric|min:1',
    ]);

    // Retrieve the goods and calculate the price (assuming price is related to goods)
    $goods = Goods::find($request->goods_id);
    $price = $goods->price;
    $total = $price * $request->count;

    // Create new order item
    $orderItem = $this->orderItem::create([
        'order_id' => $orderId,
        'goods_id' => $goods->id,
        'count' => $request->count,
        'price' => $goods->price,
        'total' => $total,
    ]);

    $order = Order::findOrFail($orderId);
    // Recalculate the total amount for the order, check if there are any remaining items
    $totalAmount = $order->order_items()->sum('total');

    // Update the order with the new total and set the current user and updated_at
    $order->price = $totalAmount;
    $order->updated_at = Carbon::now();
    $order->user_id = auth()->user()->id;
    $order->save();

    if($orderItem->goods) {
        $goods->count = $goods->count - $orderItem->count;
        $goods->save();
    }

    // Return a JSON response for the frontend
    return response()->json([
        'success' => true,
        'message' => 'Item added successfully',
        'goods' => $goods,
        'item' => $orderItem,
    ]);
}

}
