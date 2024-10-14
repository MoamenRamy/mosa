<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalMonthController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected month or default to the current month
        $month = $request->input('month', Carbon::now()->format('Y-m')); // Default is current month in 'YYYY-MM' format

        // Convert the month to a date range
        $startOfMonth = Carbon::parse($month . '-01')->startOfMonth();
        $endOfMonth = Carbon::parse($month . '-01')->endOfMonth();

        // Filter orders and debts based on the selected month
        $hotelOrders = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('price');
        $supplierOrders = Supplier_order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('price');

        $hotelsDebt = Hotel::sum('debt');
        $suppliersDebt = Supplier::sum('debt');

        // sum price - paid
        $hotelDebt_month = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->sum(DB::raw('price - paid')); // Sum price - paid

        $supplierDebt_month = Supplier_order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->sum(DB::raw('price - paid'));


        // Get user->jobTitle->salary with eager loading for better performance
        $users = User::with('jobTitle')->get();
        $totalSalaries = $users->sum(function ($user) {
            return optional($user->jobTitle)->salary ?: 0; // Use 0 if no salary
        });

        // Calculate totals
        // $hotelPaid = $hotelOrders - $hotelsDebt; // income
        // $supplierPaid = $supplierOrders - $suppliersDebt;  // out come
        // $income = $hotelPaid - $supplierPaid - $totalSalaries;
        // $total = $hotelOrders - $supplierOrders - $totalSalaries;

        $hotelIncome = $hotelOrders - $hotelDebt_month; // income
        $supplierOutcome = $supplierOrders - $supplierDebt_month;  // out come
        $income = $hotelIncome - $supplierOutcome - $totalSalaries;
        $total = $hotelOrders - $supplierOrders - $totalSalaries;

        return view('totalMonth.index', compact('hotelOrders', 'supplierOrders', 'hotelsDebt', 'suppliersDebt', 'totalSalaries', 'total', 'hotelIncome', 'supplierOutcome', 'month', 'income', 'hotelDebt_month', 'supplierDebt_month'));
    }
}
