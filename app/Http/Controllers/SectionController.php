<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Section;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Section::latest()->paginate(10);
        return view('section.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::pluck('title', 'id');
        $program = Program::pluck('title', 'id');
        return view('section.create', compact('faculty', 'department', 'program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['faculty_id' => 'required', 'program_id' => 'required', 'department_id' => 'required', 'batch_number' => 'required', 'section' => 'required']);
        $data = new Section();
        $data->faculty_id = $request->faculty_id;
        $data->department_id = $request->department_id;
        $data->program_id = $request->program_id;
        $data->batch_number = $request->batch_number;
        $data->section = $request->section;
        $data->save();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('section.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::where('faculty_id', $section->faculty_id)->pluck('title', 'id');
        $program = Program::where('department_id', $section->department_id)->pluck('title', 'id');
        return view('section.edit', compact('section', 'department', 'faculty', 'program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate(['faculty_id' => 'required', 'program_id' => 'required', 'department_id' => 'required', 'batch_number' => 'required', 'section' => 'required']);
        $section->faculty_id = $request->faculty_id;
        $section->department_id = $request->department_id;
        $section->program_id = $request->program_id;
        $section->batch_number = $request->batch_number;
        $section->section = $request->section;
        $section->update();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $section = Section::findOrfail($id);
        $section->delete();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('sec$section.index');
    }
}
