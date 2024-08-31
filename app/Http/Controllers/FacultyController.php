<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Brian2694\Toastr\Facades\Toastr;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculty = Faculty::latest()->paginate(10);
        return view('faculty.index', compact('faculty'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        $data = new Faculty();
        $data->title = $request->title;
        $data->save();
        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('faculty.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate(['title' => 'required']);
        // dd($request->all());
        $faculty->title = $request->title;
        $faculty->update();
        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('faculty.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $faculty = Faculty::findOrFail($id);
        $faculty->delete();
        Toastr::success('Operation Successful', 'Success');
        return redirect()->route('faculty.index');
    }
}
