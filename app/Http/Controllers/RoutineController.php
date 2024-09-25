<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Department;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;

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
        $course = Course::pluck('course_title', 'id');
        $teacher = Teacher::pluck('teacher_name', 'id');
        $room = Room::pluck('room_no', 'id');
        return view('routine.create', compact('faculty','course','teacher','room'));
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
    public function show(Routine $routine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Routine $routine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Routine $routine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Routine $routine)
    {
        //
    }
    public function getSections($program_id)
    {
        $section = Section::where('program_id', $program_id)->get();
        return response()->json($section);
    }
}
