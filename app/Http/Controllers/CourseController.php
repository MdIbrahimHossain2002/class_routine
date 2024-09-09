<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Course::latest()->paginate(10);
        return view('course.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::pluck('title', 'id');
        $program = Program::pluck('title', 'id');
        return view('course.create', compact('faculty', 'department', 'program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['faculty_id' => 'required', 'program_id' => 'required', 'department_id' => 'required', 'course_code' => 'required', 'course_title' => 'required', 'course_credit' => 'required']);
        $data = new Course();
        $data->faculty_id = $request->faculty_id;
        $data->department_id = $request->department_id;
        $data->program_id = $request->program_id;
        $data->course_code = $request->course_code;
        $data->course_title = $request->course_title;
        $data->course_credit = $request->course_credit;
        $data->save();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::where('faculty_id', $course->faculty_id)->pluck('title', 'id');
        $program = Program::where('department_id', $course->department_id)->pluck('title', 'id');
        return view('course.edit', compact('course', 'department', 'faculty', 'program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate(['faculty_id' => 'required', 'program_id' => 'required', 'department_id' => 'required', 'course_code' => 'required', 'course_title' => 'required', 'course_credit' => 'required']);        $course->faculty_id = $request->faculty_id;
        $course->department_id = $request->department_id;
        $course->program_id = $request->program_id;
        $course->course_code = $request->course_code;
        $course->course_title = $request->course_title;
        $course->course_credit = $request->course_credit;
        $course->update();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrfail($id);
        $course->delete();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('course.index');
    }
}
