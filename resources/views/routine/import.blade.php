@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h3 class="mb-0">Add Routine</h3>
                </div>
                <div class="card-body">
                @if(session('import_errors'))
    <div class="alert alert-danger">
        <strong>Import Errors:</strong>
        <ul>
            @foreach(session('import_errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <form action="{{ route('routine.importSubmit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col mb-4">
                            <label for="file" class="col-sm-2 col-form-label">File</label>
                            <div class="col-sm-10">
                                <input type="file" name="file" id="file" class="form-control square-input" placeholder="Enter teacher descriptiom">
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