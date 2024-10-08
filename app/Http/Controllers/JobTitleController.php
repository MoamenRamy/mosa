<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobTitles = JobTitle::paginate(12);
        return view('job_titles.index', compact('jobTitles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job_titles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required'
        ]);

        $jobTitle = new JobTitle;

        $jobTitle->name = $request->name;
        $jobTitle->salary = $request->salary;

        $jobTitle->save();

        return redirect()->route('jobTitles.index')->with('success', 'تم إضافة الوظيفة بنجاح!');
        // ->with('success', 'Job title created successfully.')
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jobTitle = JobTitle::find($id);
        return view('job_titles.show', compact('jobTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jobTitle = JobTitle::find($id);
        return view('job_titles.edit', compact('jobTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required',
        ]);

        $jobTitle = JobTitle::find($id);

        $jobTitle->name = $request->name;
        $jobTitle->salary = $request->salary;

        $jobTitle->save();

        return redirect()->route('jobTitles.index')->with('success', 'تم تعديل الوظيفة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jobTitle = JobTitle::find($id);

        $jobTitle->delete();
        return redirect()->route('jobTitles.index')->with('success', 'تم مسح الوظيفة بنجاح!');
        // ->with('success', 'Job title deleted successfully.')
    }
}
