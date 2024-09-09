<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Program::latest()->paginate(10);
        return view('program.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::pluck('title', 'id');
        return view('program.create', compact('faculty', 'department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['faculty_id' => 'required', 'department_id' => 'required', 'title' => 'required']);
        $data = new Program();
        $data->faculty_id = $request->faculty_id;
        $data->department_id = $request->department_id;
        $data->title = $request->title;
        $data->save();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('program.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::where('faculty_id', $program->faculty_id)->pluck('title', 'id');
        return view('program.edit', compact('program', 'department', 'faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate(['department_id' => 'required', 'faculty_id' => 'required', 'title' => 'required']);
        $program->department_id = $request->department_id;
        $program->faculty_id = $request->faculty_id;
        $program->title = $request->title;
        $program->update();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('program.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $program = Program::findOrfail($id);
        $program->delete();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('program.index');
    }
    public function getDepartments($faculty_id)
    {
        $department = Department::where('faculty_id', $faculty_id)->pluck('title', 'id');
        return response()->json($department);
    }
}
