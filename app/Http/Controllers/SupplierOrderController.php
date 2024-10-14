<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_order_item;
use Carbon\Carbon;
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
    public function index(Request $request)
    {
        // $orders = $this->order::with('hotel', 'user')->orderBy('created_at', 'desc')->paginate(12);
        // return view('orders.index', compact('orders'));
        $query = $this->supplierOrder::with(['supplier', 'user']) // Eager load the hotel and user relationships
              ->orderBy('created_at', 'desc'); // Order by created_at in descending order

        // Apply filters
        if ($request->filled('supplier_name')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->supplier_name . '%');
            });
        }

        // if ($request->filled('user_name')) {
        //     $query->whereHas('user', function ($q) use ($request) {
        //         $q->where('name', 'like', '%' . $request->user_name . '%');
        //     });
        // }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // if ($request->filled('paid_status')) {
        //     if ($request->paid_status == 'paid') {
        //         $query->whereColumn('paid', '=', 'price');
        //     } elseif ($request->paid_status == 'not_paid') {
        //         $query->whereColumn('paid', '<', 'price');
        //     }
        // }

        $supplierOrders = $query->paginate(12);

        // If the request is an AJAX request, return the partial view
        if ($request->ajax()) {
            return view('supplier_orders.partials.supplier_orders_list', compact('supplierOrders'))->render();
        }

        // For non-AJAX requests, return the full view
        return view('supplier_orders.index', compact('supplierOrders'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $goods = Goods::all();
        return view('supplier_orders.create', compact('suppliers', 'goods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            // 'user_id' => 'required|exists:users,id',
            // 'paid' => 'required|boolean',
            // 'price' => 'required|numeric|min:0',
            // 'order_items' => 'required|array',
            // 'order_items.*.product_id' => 'required|exists:products,id',
            'supplier_order_items' => 'required|array',
            'supplier_order_items.*.goods_id' => 'required|exists:goods,id',
            'supplier_order_items.*.count' => 'required|integer|min:1',
            // 'supplier_order_items.*.price' => 'required|numeric|min:0',
            ]);

        // Create the order
        $order = Supplier_order::create([
            'supplier_id' => $validatedData['supplier_id'],
            'user_id' => auth()->user()->id,
            'price' => 0, // Will be calculated later
            'paid' => 0,
        ]);

        // Initialize total amount
        $totalAmount = 0;
        // Create order items
        foreach ($validatedData['supplier_order_items'] as $item) {

            $good = Goods::findOrFail($item['goods_id']); // Fetch the good by its ID

            $total = $item['count'] * $good->price; // Use good's price
            $totalAmount += $total;

            // Create a new order item
            $orderItem = new Supplier_order_item();
            $orderItem->supplier_order_id = $order->id;
            $orderItem->goods_id = $item['goods_id'];
            $orderItem->count = $item['count'];
            $orderItem->price = $good->price; // Set price from good
            $orderItem->total = $total;

            $orderItem->save();

            if($orderItem->goods) {
                $good->count = $good->count + $item['count'];
                $good->save();
            }
        }
        // Update the total amount in the order
        $order->update(['price' => $totalAmount]);

        if ($order->supplier) {
            $supplier = Supplier::findOrFail($order->supplier_id);
            $supplier->debt += $order->price - $order->paid;

            $supplier->save();
        }


        return redirect()->route('supplierOrders.show', $order)->with('success', 'تم أضافة الطلبية بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier_order $supplierOrder)
    {
        $supplierOrderItems = $supplierOrder->supplier_order_items;
        return view('supplier_orders.show', compact('supplierOrder', 'supplierOrderItems'));
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
    public function destroy($id)
    {

        $supplier_order = $this->supplierOrder::findOrFail($id);
        // $supplier_order->supplier_order_items()->delete();

        // Loop through each order item
        foreach ($supplier_order->supplier_order_items as $orderItem) {
            // Find the related goods
            if($orderItem->goods) {
                $goods = $orderItem->goods;

                // Increase the goods count
                $goods->count -= $orderItem->count;

                // Save the updated goods count
                $goods->save();
            }
        }

        if($supplier_order->supplier)
        {
            $supplier = $supplier_order->supplier;
            $supplier->debt -= $supplier_order->price - $supplier_order->paid;
            $supplier->save();
        }

        $supplier_order->delete();

        return redirect()->route('supplierOrders.index')->with('success', 'تم مسح الطلبية بنجاح!');
    }

    public function destroyItem($orderId, $itemId)
    {
        // Find the order item
        $orderItem = Supplier_order_item::where('supplier_order_id', $orderId)->findOrFail($itemId);

        if($orderItem->goods) {
            $good = Goods::findOrFail($orderItem->goods_id);
            $good->count = $good->count - $orderItem->count;
            $good->save();
            // Delete the order item
            $orderItem->delete();
        }

        // Recalculate the total amount for the order
        $order = Supplier_order::findOrFail($orderId);

        if ($order->supplier) {
            $supplier = $order->supplier;
            $supplier->debt -= $orderItem->total;
            $supplier->save();
        }

        // Delete the order item
        $orderItem->delete();



        $totalAmount = $order->supplier_order_items->sum('total');

        $order->price = $totalAmount;
        $order->updated_at = Carbon::now();
        $order->user_id = auth()->user()->id;

        $order->save();

        return redirect()->back()->with('success', 'تم مسح العنصر بنجاح!');
    }

    public function updatePaid(Request $request, $id)
    {
        $supplierOrder = Supplier_order::findOrFail($id);

        $request->validate([
            'paid' => 'required|numeric|min:0|max:' . $supplierOrder->price,
        ]);

        if ($supplierOrder->supplier) {
            $supplier = $supplierOrder->supplier;
            $supplier->debt -= ($request->paid - $supplierOrder->paid);

            $supplier->save();
        }



        $supplierOrder->paid = $request->paid;

        $supplierOrder->save();



        return response()->json(['success' => true, 'message' => 'Paid amount updated successfully']);
    }
}
