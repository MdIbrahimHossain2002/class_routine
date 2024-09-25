<?php

namespace App\Http\Controllers;

use App\Imports\DepartmentImport;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Department::latest()->paginate(10);
        return view('department.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        return view('department.create', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['faculty_id' => 'required', 'title' => 'required']);
        $data = new Department();
        $data->faculty_id = $request->faculty_id;
        $data->title = $request->title;
        $data->save();
        Toastr::success('Operation Successfull', 'Successs');
        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $faculty = Faculty::pluck('title', 'id');
        return view('department.edit', compact('department', 'faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        // dd($request->all());
        $request->validate(['faculty_id' => 'required', 'title' => 'required']);
        $department->faculty_id = $request->faculty_id;
        $department->title = $request->title;
        $department->update();
        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('department.index');
    }

    public function departmentImport()
    {
        $faculty = Faculty::pluck('title', 'id');
        return view('department.import', compact('faculty'));
    }
    public function departmentImportSubmit(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);
        $faculty_id = $request->input('faculty_id');
        Excel::import(new DepartmentImport($faculty_id), $request->file('file')->store('temp'));
        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('department.index',);
    }
}
