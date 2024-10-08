<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getTodayTotalIncome()
    {
        $today = Carbon::today();
        // Assuming your column for total order income is 'price'
        $totalIncome = Order::whereDate('created_at', $today)->sum('price');

        return $totalIncome;
    }

    public function getTodayTotalGoodsSold()
    {
        $today = Carbon::today(); // Gets the current day's start time
        // Assuming 'quantity' is the column storing the number of items sold
        $totalGoodsSold = Order_item::whereDate('created_at', $today)->sum('count');

        return $totalGoodsSold;
    }

    public function dashboard()
    {
        $totalIncome = $this->getTodayTotalIncome(); // Get total income for today
        $totalGoodsSold = $this->getTodayTotalGoodsSold(); // Get total goods sold today

        return view('dashboard', compact('totalIncome', 'totalGoodsSold'));
    }
}
