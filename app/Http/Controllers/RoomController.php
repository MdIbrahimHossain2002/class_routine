<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Room;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Room::latest()->paginate(10);
        return view('room.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::pluck('title', 'id');
        return view('room.create', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['faculty_id' => 'required', 'department_id' => 'required', 'room_no' => 'required', 'student_capacity' => 'required']);
        $data = new Room();
        $data->faculty_id = $request->faculty_id;       
        $data->department_id = $request->department_id;        
        $data->room_no = $request->room_no;
        $data->student_capacity = $request->student_capacity;
        $data->save();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $faculty = Faculty::pluck('title', 'id');
        $department = Department::where('faculty_id', $room->faculty_id)->pluck('title', 'id');
        return view('room.edit', compact('room', 'department', 'faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate(['faculty_id' => 'required', 'department_id' => 'required', 'room_no' => 'required', 'student_capacity' => 'required']);      
        $room->faculty_id = $request->faculty_id;
        $room->department_id = $request->department_id;
        $room->room_no = $request->room_no;
        $room->student_capacity = $request->student_capacity;
        $room->update();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Room::findOrfail($id);
        $teacher->delete();
        Toastr::success('Operation Succesfull', 'Success');
        return redirect()->route('room.index');
    }
}
