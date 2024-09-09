@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Add Course</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="faculty_id" class="col-form-label">Faculty <span class="text-danger">*</span></label>
                                <select name="faculty_id" id="faculty_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Faculty</option>
                                    @foreach($faculty as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="department_id" class="col-form-label">Department<span class="text-danger">*</span></label>
                                <select name="department_id" id="department_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Department</option>
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
                                </select>
                                @error('program_id')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="course_code" class="col-form-label">Course Code <span class="text-danger">*</span></label>
                                <input type="text" name="course_code" id="course_code" class="form-control square-input" placeholder="Enter course code" style="width: 100%;">
                                @error('course_code')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="course_title" class="col-form-label">Course Title <span class="text-danger">*</span></label>
                                <input type="text" name="course_title" id="course_title" class="form-control square-input" placeholder="Enter course title" style="width: 100%;">
                                @error('course_title')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="course_credit" class="col-form-label">Course Credit<span class="text-danger">*</span></label>
                                <input type="text" name="course_credit" id="course_credit" class="form-control square-input" placeholder="Enter course credit" style="width: 100%;">
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
                                        <i class="fas fa-save"></i> Save
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