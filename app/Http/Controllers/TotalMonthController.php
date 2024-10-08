<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\User;
use Illuminate\Http\Request;

class TotalMonthController extends Controller
{
    public function index()
    {
        $hotelOrders = Order::sum('price');  // This is already optimized
        $supplierOrders = Supplier_order::sum('price');  // This is already optimized
        $hotelsDebt = Hotel::sum('debt');  // Avoid fetching all hotel records
        $suppliersDebt = Supplier::sum('debt');  // Avoid fetching all supplier records

        // Get user->jobTitle->salary with eager loading for better performance
        $users = User::with('jobTitle')->get();  // Eager load jobTitle relationship
        $totalSalaries = $users->sum(function ($user) {
            return optional($user->jobTitle)->salary ?: 0; // Use 0 if no salary
        });

        $hotelPaid = $hotelOrders - $hotelsDebt;
        $supplierPaid = $supplierOrders - $suppliersDebt;

        $total = $hotelPaid + $supplierPaid - $totalSalaries;
        // $income = $hotelPaid + $supplierPaid - $totalSalaries;

        return view('totalMonth.index', compact('hotelOrders', 'supplierOrders', 'hotelsDebt', 'suppliersDebt', 'totalSalaries', 'total', 'hotelPaid', 'supplierPaid'));
    }
}
