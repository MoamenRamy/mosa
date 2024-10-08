<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user::with('jobTitle')->paginate(12);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user::with('jobTitle')->findOrFail($id);
        $jobTitle = JobTitle::all();  // Assuming you have a JobTitle model
        return view('users.edit', compact('user', 'jobTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'jobTitle_id' => 'required|exists:job_titles,id',
            // Add validation for other fields here
            'phone' => 'nullable|numeric|digits:11',
            'role' => 'required',
        ]);

        $user = $this->user::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->jobTitle_id = $request->jobTitle_id;
        // Add other fields here
        $user->phone = $request->phone;
        $user->role = $request->role;

        $user->update();

        return redirect()->route('users.index')->with('success', 'تم تعديل الموظف بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->user::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'تم مسح الموظف بنجاح!');
    }
}
