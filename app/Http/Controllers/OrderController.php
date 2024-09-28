<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_item;
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
        $orders = $this->order::paginate(12);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        $order = Order::create([
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

        Order_item::create([
        'order_id' => $order->id,
        'goods_id' => $item['goods_id'],
        'count' => $item['count'],
        'price' => $item['price'],
        'total' => $total,
        ]);
        }
        // Update the total amount in the order
        $order->update(['price' => $totalAmount]);

        return redirect()->route('hotels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
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

        return redirect()->route('orders.index');
    }

    public function destroyItem($orderId, $itemId)
    {
        // Find the order item
        $orderItem = Order_item::where('order_id', $orderId)->findOrFail($itemId);

        // Delete the order item
        $orderItem->delete();

        // Recalculate the total amount for the order
        $order = Order::findOrFail($orderId);
        $totalAmount = $order->orderItems->sum('total');
        $order->update(['price' => $totalAmount]);

        return redirect()->back();
    }
}
