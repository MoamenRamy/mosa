<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Order_item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->order::with('hotel', 'user')->orderBy('created_at', 'desc')->paginate(12);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        $goods = Goods::all();
        return view('orders.create', compact('hotels', 'goods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            // 'paid' => 'required|boolean',
            // 'price' => 'required|numeric|min:0',
            // 'order_items' => 'required|array',
            // 'order_items.*.product_id' => 'required|exists:products,id',
            'order_items' => 'required|array',
            'order_items.*.goods_id' => 'required|exists:goods,id',
            'order_items.*.count' => 'required|integer|min:1',
            // 'order_items.*.price' => 'required|numeric|min:0',
            ]);

        // Create the order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'hotel_id' => $validatedData['hotel_id'],
            'price' => 0, // Will be calculated later
            'paid' => 0,
        ]);

        // Initialize total amount
        $totalAmount = 0;
        // Create order items
        foreach ($validatedData['order_items'] as $item) {

            $good = Goods::findOrFail($item['goods_id']); // Fetch the good by its ID

            $total = $item['count'] * $good->price; // Use good's price
            $totalAmount += $total;

            // Create a new order item
            $orderItem = new Order_item();
            $orderItem->order_id = $order->id;
            $orderItem->goods_id = $item['goods_id'];
            $orderItem->count = $item['count'];
            $orderItem->price = $good->price; // Set price from good
            $orderItem->total = $total;

            $orderItem->save();
        }
        // Update the total amount in the order
        $order->update(['price' => $totalAmount]);

        return redirect()->route('orders.show', $order)->with('success', 'تم إضافة الطلبية بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderItems = $order->order_items;
        $goods = Goods::all();
        return view('orders.show', compact('order', 'orderItems', 'goods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            // 'paid' => 'required|boolean',
            // 'price' => 'required|numeric|min:0',
            // 'order_items' => 'required|array',
            // 'order_items.*.product_id' => 'required|exists:products,id',
            'order_items' => 'required|array',
            'order_items.*.goods_id' => 'required|exists:goods,id',
            'order_items.*.count' => 'required|integer|min:1',
            'order_items.*.price' => 'required|numeric|min:0',
            ]);

        // Create the order
        $order->update([
            'user_id' => $validatedData['user_id'],
            'hotel_id' => $validatedData['hotel_id'],
            'price' => 0, // Will be calculated later
            'paid' => $request->paid,
        ]);

        // Initialize total amount
        $totalAmount = 0;
        // Create order items
        foreach ($validatedData['order_items'] as $item) {

        $total = $item['count'] * $item['price'];
        $totalAmount += $total;

        if (isset($item['id'])) {
            // Update existing order item
            $orderItem = Order_item::findOrFail($item['id']);
            $orderItem->update([
                'goods_id' => $item['goods_id'],
                'count' => $item['count'],
                'price' => $item['price'],
                'total' => $total,
            ]);
        } else {
            // Create new order item
            Order_item::create([
                'order_id' => $order->id,
                'goods_id' => $item['goods_id'],
                'count' => $item['count'],
                'price' => $item['price'],
                'total' => $total,
            ]);
        }
        }
        // Update the total amount in the order
        $order->update(['price' => $totalAmount]);

        return redirect()->route('hotels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->order_items()->delete();

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'تم مسح الطلبية بنجاح!');
    }

    public function destroyItem($orderId, $itemId)
{
    // Find the order item by order_id and item id
    $orderItem = Order_item::where('order_id', $orderId)->findOrFail($itemId);

    // Delete the order item
    $orderItem->delete();

    // Find the order
    $order = Order::findOrFail($orderId);

    // Recalculate the total amount for the order, check if there are any remaining items
    $totalAmount = $order->order_items()->sum('total');

    // Update the order with the new total and set the current user and updated_at
    $order->price = $totalAmount;
    $order->updated_at = Carbon::now();
    $order->user_id = auth()->user()->id;
    $order->save();

    return redirect()->back()->with('success', 'تم مسح العنصر بنجاح!');
}

public function updatePaid(Request $request, $id)
{
    $order = $this->order::find($id);

    $request->validate([
        'paid' => 'required|numeric|min:0|max:' . $order->price,
    ]);


    $order->paid = $request->paid;

    $order->save();

    return response()->json(['success' => true, 'message' => 'Paid amount updated successfully']);
}

}

