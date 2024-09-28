<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    public $jobTitle;

    public function __construct( JobTitle $jobTitle )
    {
        $this->$jobTitle = $jobTitle;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobTitles = $this->jobTitle::paginate(12);
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

        $jobTitle = new $this->jobTitle;

        $jobTitle->name = $request->name;
        $jobTitle->salary = $request->salary;

        $jobTitle->save();

        return redirect()->route('job_titles.index');
        // ->with('success', 'Job title created successfully.')
    }

    /**
     * Display the specified resource.
     */
    public function show(JobTitle $jobTitle)
    {
        return view('job_titles.show', compact('jobTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobTitle $jobTitle)
    {
        return view('job_titles.edit', compact('jobTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobTitle $jobTitle)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required',
        ]);

        $jobTitle->name = $request->name;
        $jobTitle->salary = $request->salary;

        $jobTitle->save();

        return redirect()->route('job_titles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobTitle $jobTitle)
    {
        $jobTitle->delete();
        return redirect()->route('job_titles.index');
        // ->with('success', 'Job title deleted successfully.')
    }
}
