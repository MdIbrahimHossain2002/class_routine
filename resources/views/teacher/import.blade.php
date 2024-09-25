@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Add Teacher</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.importSubmit') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group col mb-4">
                                <label for="file" class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" id="file" class="form-control square-input" placeholder="Enter teacher descriptiom">
                                </div>
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