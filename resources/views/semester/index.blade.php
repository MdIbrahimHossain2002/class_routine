@extends('layout')
@section('content')
<div class="container mt-5">
  <div class="row mb-4">
    <div class="col-md-6 d-flex align-items-center">
      <h3 class="mb-0">Semester</h3>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
      <a class="btn btn-success btn-sm" href="{{ route('semester.create') }}">
        <i class="fas fa-plus"></i> Add Semester
      </a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center align-middle">
      <thead>
        <tr>
          <th scope="col">SL</th>
          <th scope="col">Faculty</th>
          <th scope="col">Department</th>
          <th scope="col">Semester</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $semester)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td> {{ @$semester->faculty->title}}</td>
          <td> {{ @$semester->department->title}}</td>
          <td>{{ $semester->title }}</td>
          <td>
            <a href="{{ route('semester.edit', $semester->id) }}" class="btn btn-light btn-sm me-2">
              <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('semester.destroy', $semester->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are You Sure You want To Delete?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash-alt"></i> Delete
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr col="30">
          <td colspan="5" class="text-center">No data found</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-end">
    {!! $data->links() !!}
  </div>
</div>
@endsection