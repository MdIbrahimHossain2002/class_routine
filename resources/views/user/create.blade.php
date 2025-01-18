@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Add New User</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter user name">
                                @error('name')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address">
                                @error('email')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password address">
                                @error('password')
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
