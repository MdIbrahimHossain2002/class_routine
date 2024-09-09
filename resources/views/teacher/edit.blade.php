@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Edit Teacher</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="faculty_id" class="col-form-label">Faculty <span class="text-danger">*</span></label>
                                <select name="faculty_id" id="faculty_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Faculty</option>
                                    @foreach($faculty as $key=>$item)
                                    @if($teacher->faculty_id == $key)
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
                                    @if($teacher->department_id == $key)
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
                                <label for="teacher_name" class="col-form-label">Teacher Name <span class="text-danger">*</span></label>
                                <input type="text" name="teacher_name" id="teacher_name" class="form-control square-input" placeholder="Enter faculty name" value="{{$teacher->teacher_name}}" style="width: 100%;">
                                @error('teacher_name')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="teacher_phone" class="col-form-label">Teacher Phone <span class="text-danger">*</span></label>
                                <input type="text" name="teacher_phone" id="teacher_phone" class="form-control square-input" placeholder="Enter faculty name" value="{{$teacher->teacher_phone}}" style="width: 100%;">
                                @error('teacher_phone')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="teacher_email" class="col-form-label">Teacher Email <span class="text-danger">*</span></label>
                                <input type="text" name="teacher_email" id="teacher_email" class="form-control square-input" placeholder="Enter faculty name" value="{{$teacher->teacher_email}}" style="width: 100%;">
                                @error('teacher_email')
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