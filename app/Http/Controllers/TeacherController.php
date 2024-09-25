<?php

namespace App\Http\Controllers;

use App\Imports\TeacherImport;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Teacher::latest()->paginate(10);
        return view('teacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::pluck('title', 'id');
        return view('teacher.create', compact('faculty', 'department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['faculty_id' => 'required', 'department_id' => 'required', 'teacher_name' => 'required', 'teacher_phone' => 'required', 'teacher_email' => 'required']);
        $data = new Teacher();
        $data->faculty_id = $request->faculty_id;
        $data->department_id = $request->department_id;
        $data->teacher_name = $request->teacher_name;
        $data->teacher_phone = $request->teacher_phone;
        $data->teacher_email = $request->teacher_email;
        $data->save();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('teacher.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::where('faculty_id', $teacher->faculty_id)->pluck('title', 'id');
        return view('teacher.edit', compact('teacher', 'department', 'faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate(['faculty_id' => 'required', 'department_id' => 'required', 'teacher_name' => 'required', 'teacher_phone' => 'required', 'teacher_email' => 'required']);
        $teacher->department_id = $request->department_id;
        $teacher->faculty_id = $request->faculty_id;
        $teacher->teacher_name = $request->teacher_name;
        $teacher->teacher_phone = $request->teacher_phone;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->update();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrfail($id);
        $teacher->delete();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('teacher.index');
    }
    public function getDepartments($faculty_id)
    {
        $department = Department::where('faculty_id', $faculty_id)->pluck('title', 'id');
        return response()->json($department);
    }
    public function getPrograms($department_id)
    {
        $data['program'] = Program::where('department_id', $department_id)->pluck('title', 'id');
        $data['semester'] = Semester::where('department_id', $department_id)->pluck('title', 'id');
        return response()->json($data);
    }

    public function teacherImport(Teacher $teacher)
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::where('faculty_id', $teacher->faculty_id)->pluck('title', 'id');
        return view('teacher.import', compact('faculty', 'department', 'teacher'));
    }
    public function teacherimportSubmit(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);
        $faculty_id = $request->input('faculty_id');
        $department_id = $request->input('department_id');
        Excel::import(new TeacherImport($faculty_id, $department_id), $request->file('file'));
        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('teacher.index');
    }
}
