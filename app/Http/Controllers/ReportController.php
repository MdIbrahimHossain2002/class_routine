<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Report;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Bus\Batch;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\RoutineDetail;

use Barryvdh\DomPDF\Facade\Pdf;
use function PHPSTORM_META\type;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function batch(Request $request)
    {
        $batch = Section::all();
        $routines = [];
        if ($request->section_id) {
            $routines = Routine::where('section_id', $request->section_id)->get();
        }
        return view('report.batch', compact('batch', 'routines'));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function room(Request $request)
    {
        $room = Room::all();
        $routines = [];
        if ($request->has('room_id')) {
            $routines = RoutineDetail::where('room_id', $request->room_id)->get();
        }

        return view('report.room', compact('room', 'routines'));
    }

    public function teacher(Request $request)
    {
        $department = Department::pluck('title', 'id');
        $teacher = Teacher::all();
        $routines = [];
        if ($request->has('teacher_id')) {
            $routines = RoutineDetail::where('teacher_id', $request->teacher_id)->get();
        }


        return view('report.teacher', compact('teacher', 'routines','department'));
    }

    public function export(Request $request)
    {
        $routines = Routine::where('section_id', $request->filter['section_id'])->get();
        if (isset($request->type) && $request->type == 'pdf') {
            $pdf = PDF::loadView('report.export_batch', compact('routines'));
            return $pdf->download('batch_wise_routine.pdf');
        } else if (isset($request->type) && $request->type == 'print') {
            $is_print = true;
            return view('report.export_batch', compact('routines', 'is_print'));
        }
    }

    public function export2(Request $request)
    {
        $routines = RoutineDetail::where('room_id', $request->filter['room_id'])->get();
        if (isset($request->type) && $request->type == 'pdf') {
            $pdf = PDF::loadView('report.export_room', compact('routines'));
            return $pdf->download('room_wise_routine.pdf');
        } else if (isset($request->type) && $request->type == 'print') {
            $is_print = true;
            return view('report.export_room', compact('routines', 'is_print'));
        }
    }

    public function export3(Request $request)
    {
        $routines = RoutineDetail::where('teacher_id', $request->filter['teacher_id'])->get();
        if (isset($request->type) && $request->type == 'pdf') {
            $pdf = PDF::loadView('report.export_teacher', compact('routines'));
            return $pdf->download('teacher_wise_routine.pdf');
        } else if (isset($request->type) && $request->type == 'print') {
            $is_print = true;
            return view('report.export_teacher', compact('routines', 'is_print'));
        }
    }

    public function getTeachers($teacher_id)
    {

        $teacher = Teacher::where('department_id', $teacher_id)->pluck('teacher_name', 'id');
        return response()->json($teacher);
    }

    public function day(Request $request)
    {
        $routineDetail = [];
        if ($request->has('day')) {
            $routineDetail = RoutineDetail::where('day_one', $request->day)->orWhere('day_two', $request->day)->get();
        }
        $routineDetail = collect($routineDetail);
        return view('report.day', compact('routineDetail'));
    }
    public function export4(Request $request)
    {
        $routines = Routine::where('section_id', $request->filter['section_id'])->get();
        if (isset($request->type) && $request->type == 'pdf') {
            $pdf = PDF::loadView('report.export_batch', compact('routines'));
            return $pdf->download('batch_wise_routine.pdf');
        } else if (isset($request->type) && $request->type == 'print') {
            $is_print = true;
            return view('report.export_batch', compact('routines', 'is_print'));
        }
    }
}
