@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Edit Course</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="faculty_id" class="col-form-label">Faculty <span class="text-danger">*</span></label>
                                <select name="faculty_id" id="faculty_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Faculty</option>
                                    @foreach($faculty as $key=>$item)
                                    @if($course->faculty_id == $key)
                                    <option value="{{$key}}" selected>{{$item}}</option>
                                    @else
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('faculty_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="department_id" class="col-form-label">Department <span class="text-danger">*</span></label>
                                <select name="department_id" id="department_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Department</option>
                                    @foreach($department as $key=>$item)
                                    @if($course->department_id == $key)
                                    <option value="{{$key}}" selected>{{$item}}</option>
                                    @else
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('department_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="program_id" class="col-form-label">Program<span class="text-danger">*</span></label>
                                <select name="program_id" id="program_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Program</option>
                                    @foreach($program as $key=>$item)
                                    @if($course->program_id == $key)
                                    <option value="{{$key}}" selected>{{$item}}</option>
                                    @else
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('program_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="course_code" class="col-form-label">Course Code <span class="text-danger">*</span></label>
                                <input type="text" name="course_code" id="course_code" class="form-control square-input" placeholder="Enter faculty name" value="{{$course->course_code}}" style="width: 100%;">
                                @error('course_code')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="course_title" class="col-form-label">Course Title <span class="text-danger">*</span></label>
                                <input type="text" name="course_title" id="course_title" class="form-control square-input" placeholder="Enter faculty name" value="{{$course->course_title}}" style="width: 100%;">
                                @error('course_title')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="course_credit" class="col-form-label">Course Credit <span class="text-danger">*</span></label>
                                <input type="text" name="course_credit" id="course_credit" class="form-control square-input" placeholder="Enter faculty name" value="{{$course->course_credit}}" style="width: 100%;">
                                @error('course_credit')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit" id="submit" class="btn btn-success text-uppercase">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection