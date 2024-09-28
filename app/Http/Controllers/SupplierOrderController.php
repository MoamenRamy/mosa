<?php

namespace App\Http\Controllers;

use App\Models\Supplier_order;
use App\Models\Supplier_order_item;
use Illuminate\Http\Request;

class SupplierOrderController extends Controller
{

    public $supplierOrder;

    public function __construct(Supplier_order $supplierOrder)
    {
        $this->supplierOrder = $supplierOrder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplierOrders = $this->supplierOrder::paginate(12);
        return view('supplier_orders.index', compact('supplierOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier_orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id' => 'required|exists:users,id',
            // 'paid' => 'required|boolean',
            // 'price' => 'required|numeric|min:0',
            // 'order_items' => 'required|array',
            // 'order_items.*.product_id' => 'required|exists:products,id',
            'supplier_order_items' => 'required|array',
            'supplier_order_items.*.goods_id' => 'required|exists:goods,id',
            'supplier_order_items.*.count' => 'required|integer|min:1',
            'supplier_order_items.*.price' => 'required|numeric|min:0',
            ]);

        // Create the order
        $order = Supplier_order::create([
            'supplier_id' => $validatedData['supplier_id'],
            'user_id' => $validatedData['user_id'],
            'price' => 0, // Will be calculated later
            'paid' => $request->paid,
        ]);

        // Initialize total amount
        $totalAmount = 0;
        // Create order items
        foreach ($validatedData['supplier_order_items'] as $item) {

        $total = $item['count'] * $item['price'];
        $totalAmount += $total;

        Supplier_order_item::create([
        'supplier_order_id' => $order->id,
        'goods_id' => $item['goods_id'],
        'count' => $item['count'],
        'price' => $item['price'],
        'total' => $total,
        ]);
        }
        // Update the total amount in the order
        $order->update(['price' => $totalAmount]);

        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier_order $supplier_order)
    {
        return view('supplier_orders.show', compact('supplier_order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier_order $supplier_order)
    {
        return view('supplier_orders.edit', compact('supplier_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier_order $supplier_order)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id' => 'required|exists:users,id',
            // 'paid' => 'required|boolean',
            // 'price' => 'required|numeric|min:0',
            // 'order_items' => 'required|array',
            // 'order_items.*.product_id' => 'required|exists:products,id',
            'supplier_order_items' => 'required|array',
            'supplier_order_items.*.goods_id' => 'required|exists:goods,id',
            'supplier_order_items.*.count' => 'required|integer|min:1',
            'supplier_order_items.*.price' => 'required|numeric|min:0',
            ]);

        // Create the order
        $supplier_order->update([
            'user_id' => $validatedData['user_id'],
            'supplier_id' => $validatedData['supplier_id'],
            'price' => 0, // Will be calculated later
            'paid' => $request->paid,
        ]);

        // Initialize total amount
        $totalAmount = 0;
        // Create order items
        foreach ($validatedData['supplier_order_items'] as $item) {

        $total = $item['count'] * $item['price'];
        $totalAmount += $total;

        if (isset($item['id'])) {
            // Update existing order item
            $orderItem = Supplier_order_item::findOrFail($item['id']);
            $orderItem->update([
                'goods_id' => $item['goods_id'],
                'count' => $item['count'],
                'price' => $item['price'],
                'total' => $total,
            ]);
        } else {
            // Create new order item
            Supplier_order_item::create([
                'supplier_order_id' => $supplier_order->id,
                'goods_id' => $item['goods_id'],
                'count' => $item['count'],
                'price' => $item['price'],
                'total' => $total,
            ]);
        }
        }
        // Update the total amount in the order
        $supplier_order->update(['price' => $totalAmount]);

        return redirect()->route('suppliers.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier_order $supplier_order)
    {
        $supplier_order->supplier_order_items()->delete();

        $supplier_order->delete();

        return redirect()->route('supplier_orders.index');
    }

    public function destroyItem($orderId, $itemId)
    {
        // Find the order item
        $orderItem = Supplier_order_item::where('supplier_order_id', $orderId)->findOrFail($itemId);

        // Delete the order item
        $orderItem->delete();

        // Recalculate the total amount for the order
        $order = Supplier_order::findOrFail($orderId);
        $totalAmount = $order->supplier_order_items()->sum('total');
        $order->update(['price' => $totalAmount]);

        return redirect()->back();
    }
}
