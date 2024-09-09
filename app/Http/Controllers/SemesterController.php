<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Semester;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Semester::latest()->paginate(10);
         return view('semester.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::pluck('title', 'id');        
        return view('semester.create',compact('faculty','department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['faculty_id' => 'required', 'department_id' => 'required', 'title' => 'required']);
        $data = new Semester();
        $data->faculty_id = $request->faculty_id;
        $data->department_id = $request->department_id;
        $data->title = $request->title;
        $data->save();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('semester.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::where('faculty_id',$semester->faculty_id)->pluck('title', 'id');        
        return view('semester.edit', compact('semester','department', 'faculty'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        $request->validate(['department_id' => 'required','faculty_id'=>'required', 'title'=>'required']);
        $semester->department_id = $request->department_id;
        $semester->faculty_id = $request->faculty_id;
        $semester->title = $request->title;
        $semester->update();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('semester.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $semester = Semester::findOrfail($id);
        $semester->delete();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('semester.index');
    
    }
}
