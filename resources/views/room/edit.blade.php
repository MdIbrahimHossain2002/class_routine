@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Edit Room</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <div class="col-sm-6">
                                <label for="faculty_id" class="col-form-label">Faculty <span class="text-danger">*</span></label>
                                <select name="faculty_id" id="faculty_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Faculty</option>
                                    @foreach($faculty as $key=>$item)
                                    @if($room->faculty_id == $key)
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
                                    @if($room->department_id == $key)
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
                                <label for="room_no" class="col-form-label">Room Number <span class="text-danger">*</span></label>
                                <input type="text" name="room_no" id="room_no" class="form-control square-input" placeholder="Enter faculty name" value="{{$room->room_no}}" style="width: 100%;">
                                @error('room_no')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="student_capacity" class="col-form-label">Student Capacity<span class="text-danger">*</span></label>
                                <input type="text" name="student_capacity" id="student_capacity" class="form-control square-input" placeholder="Enter faculty name" value="{{$room->student_capacity}}" style="width: 100%;">
                                @error('student_capacity')
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