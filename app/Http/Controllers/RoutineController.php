<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\RoutineDetail;
use App\Imports\RoutineImport;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Routine::latest()->paginate(10);
        return view('routine.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        $course = Course::pluck('course_code', 'id');
        $teacher = Teacher::pluck('teacher_name', 'id');
        $room = Room::pluck('room_no', 'id');
        return view('routine.create', compact('faculty', 'course', 'teacher', 'room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required',
            'department_id' => 'required',
            'program_id' => 'required',
            'semester_id' => 'required',
            'section_id' => 'required',
            'course_id' => 'required|array|min:1',
            'course_id.*' => 'required',
            'teacher_id' => 'required|array|min:1',
            'teacher_id.*' => 'required',
            'time' => 'required|array|min:1',
            'time.*' => 'required',
            'day_one' => 'required|array|min:1',
            'day_one.*' => 'required',
            'day_two' => 'required|array|min:1',
            'room_id' => 'required|array|min:1',
            'room_id.*' => 'required',
        ], [
            'faculty_id.required' => 'The Faculty field is required.',
            'department_id.required' => 'The Department field is required.',
            'program_id.required' => 'The Program field is required.',
            'semester_id.required' => 'The Semester field is required.',
            'section_id.required' => 'The Section field is required.',
            'course_id.required' => 'At least one Course is required.',
            'course_id.*.required' => 'Course field is required for row :position.',
            'teacher_id.required' => 'At least one Teacher is required.',
            'teacher_id.*.required' => 'Teacher field is required for row :position.',
            'time.required' => 'At least one Time is required.',
            'time.*.required' => 'Time field is required for row :position.',
            'day_one.required' => 'At least one Day is required.',
            'day_one.*.required' => 'Day field is required for row :position.',
            'room_id.required' => 'At least one Room is required.',
            'room_id.*.required' => 'Room field is required for row :position.',
        ]);
        $data = new Routine();
        $data->faculty_id = $request->faculty_id;
        $data->department_id = $request->department_id;
        $data->program_id = $request->program_id;
        $data->semester_id = $request->semester_id;
        $data->section_id = $request->section_id;
        $data->save();
        foreach ($request['course_id'] as $index => $course_id) {

            $routineDetail = new RoutineDetail();
            $routineDetail->routine_id = $data->id;
            $routineDetail->course_id = $course_id;
            $routineDetail->teacher_id = $request['teacher_id'][$index];
            $routineDetail->time = $request['time'][$index];
            $routineDetail->day_one = $request['day_one'][$index];
            $routineDetail->day_two = $request['day_two'][$index];
            $routineDetail->room_id = $request['room_id'][$index];
            $routineDetail->save();
        }
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('routine.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Routine $routine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Routine $routine)
    {
        $faculty = Faculty::pluck('title', 'id');
        $course = Course::pluck('course_code', 'id');
        $teacher = Teacher::pluck('teacher_name', 'id');
        $room = Room::pluck('room_no', 'id');
        $department = Department::pluck('title', 'id');
        $program = Program::pluck('title', 'id');
        $section = Section::all();
        $semester = Semester::pluck('title', 'id');

        return view('routine.edit', compact('faculty', 'course', 'teacher', 'room', 'routine', 'department', 'program', 'section', 'semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Routine $routine)
    {
        $request->validate([
            'faculty_id' => 'required',
            'department_id' => 'required',
            'program_id' => 'required',
            'semester_id' => 'required',
            'section_id' => 'required',
            'course_id' => 'required|array|min:1',
            'course_id.*' => 'required',
            'teacher_id' => 'required|array|min:1',
            'teacher_id.*' => 'required',
            'time' => 'required|array|min:1',
            'time.*' => 'required',
            'day_one' => 'required|array|min:1',
            'day_one.*' => 'required',
            'day_two' => 'required|array|min:1',
            'room_id' => 'required|array|min:1',
            'room_id.*' => 'required',
        ], [
            'faculty_id.required' => 'The Faculty field is required.',
            'department_id.required' => 'The Department field is required.',
            'program_id.required' => 'The Program field is required.',
            'semester_id.required' => 'The Semester field is required.',
            'section_id.required' => 'The Section field is required.',
            'course_id.required' => 'At least one Course is required.',
            'course_id.*.required' => 'Course field is required for row :position.',
            'teacher_id.required' => 'At least one Teacher is required.',
            'teacher_id.*.required' => 'Teacher field is required for row :position.',
            'time.required' => 'At least one Time is required.',
            'time.*.required' => 'Time field is required for row :position.',
            'day_one.required' => 'At least one Day is required.',
            'day_one.*.required' => 'Day field is required for row :position.',
            'room_id.required' => 'At least one Room is required.',
            'room_id.*.required' => 'Room field is required for row :position.',
        ]);
        $data = Routine::find($routine->id);
        $data->faculty_id = $request->faculty_id;
        $data->department_id = $request->department_id;
        $data->program_id = $request->program_id;
        $data->semester_id = $request->semester_id;
        $data->section_id = $request->section_id;
        $data->update();
        RoutineDetail::where('routine_id', $data->id)->delete();
        foreach ($request['course_id'] as $index => $course_id) {

            $routineDetail = new RoutineDetail();
            $routineDetail->routine_id = $data->id;
            $routineDetail->course_id = $course_id;
            $routineDetail->teacher_id = $request['teacher_id'][$index];
            $routineDetail->time = $request['time'][$index];
            $routineDetail->day_one = $request['day_one'][$index];
            $routineDetail->day_two = $request['day_two'][$index];
            $routineDetail->room_id = $request['room_id'][$index];
            $routineDetail->save();
        }
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('routine.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $routine = Routine::findOrFail($id);

        RoutineDetail::where('routine_id', $routine->id)->delete();

        $routine->delete();

        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('routine.index');
    }
    public function getSections($program_id)
    {
        $section = Section::where('program_id', $program_id)->get();
        return response()->json($section);
    }

    public function getCourse(Request $request)
    {
        $course = Course::where('id', $request->course_id)->first();
        return response()->json($course);
    }
    public function routineImport(Request $request)
    {
        $faculty = Faculty::pluck('title', 'id');
        $course = Course::pluck('course_code', 'id');
        $teacher = Teacher::pluck('teacher_name', 'id');
        $room = Room::pluck('room_no', 'id');
        return view('routine.import', compact('faculty', 'course', 'teacher', 'room'));
    }
    public function routineImportSubmit(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        try {
            $file = $request->file('file');
            $import = new RoutineImport($file); // Pass the file here
            Excel::import($import, $file);

            $errors = $import->getErrors();
            if (!empty($errors)) {
                session()->flash('import_errors', $errors);
                return redirect()->back();
            } else {
                Toastr::success('Routine imported successfully!', 'Success');
            }
        } catch (\Exception $e) {
            Log::error('Routine Import Error: ' . $e->getMessage());
            Toastr::error('An error occurred during the import. Please check the file and try again.', 'Error');
        }

        return redirect()->route('routine.index');
    }
}
