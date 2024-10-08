<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = $this->supplier::paginate();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:11|unique:suppliers,phone',
            // 'address' => 'required',
        ]);

        $supplier = new $this->supplier;

        $supplier->name = $request->name;
        $supplier->phone = $request->phone;

        if ($request->address) {
            $supplier->address = $request->address;
        }

        if ($request->debt) {
            $supplier->debt = $request->debt;
        }

        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'تم إضافة المورد بنجاح!');
        // ->with('success', 'Supplier added successfully')
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:11|unique:suppliers,phone',
        ]);

        $supplier->name = $request->name;
        $supplier->phone = $request->phone;

        if ($request->address) {
            $supplier->address = $request->address;
        }

        if ($request->debt) {
            $supplier->debt = $request->debt;
        }

        $supplier->update();

        return redirect()->route('suppliers.index')->with('success', 'تم تعديل المورد بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'تم مسح المورد بنجاح!');
    }
}
