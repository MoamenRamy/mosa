<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public $hotel;

    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->hotel::query();  // Adjust this based on how you are querying categories

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $hotels = $query->paginate(12);

        // If the request is an AJAX request, return the partial view
        if ($request->ajax()) {
            return view('hotels.partials.hotels_list', compact('hotels'))->render();
        }
        return view('hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'stars' => 'required|integer|between:0,7',
        ]);

        $hotel = new $this->hotel;

        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->stars = $request->stars;
        $hotel->sales = $request->sales;
        $hotel->debt = $request->debt;
        $hotel->last_supply_date = $request->last_supply_date;
        $hotel->last_supply_count = $request->last_supply_count;

        $hotel->save();

        return redirect()->route('hotels.index')->with('success', 'تم إضافة الفندق بنجاح!');

        // ->with('success', 'Hotel created successfully.')    -->> make success
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'stars' => 'required|integer|between:0,7',
        ]);

        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->stars = $request->stars;
        $hotel->sales = $request->sales;
        // $hotel->debt = $request->debt;
        $hotel->last_supply_date = $request->last_supply_date;
        $hotel->last_supply_count = $request->last_supply_count;

        if($request->addDebt)
        {
            $addDebt = $hotel->debt + $request->addDebt;
            $hotel->debt = $addDebt;
        }

        if($request->paid)
        {
            $paid = $hotel->debt - $request->paid;
            $hotel->debt = $paid;
        }

        $hotel->update();

        // return redirect()->route('hotels.show', $hotel);
        return redirect()->route('hotels.index')->with('success', 'تم تعديل الفندق بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'تم مسح الفندق بنجاح!');
    }
}
