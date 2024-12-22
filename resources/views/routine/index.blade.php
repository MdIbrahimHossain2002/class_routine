@extends('layout')

@section('content')
<div class="container mt-5">
  <div class="row mb-4">
    <div class="col-md-6 d-flex align-items-center">

      <h3 class="mb-0">Routine</h3>

    </div>
    <div class="col-md-6 d-flex justify-content-end">
      <a class="btn btn-success btn-sm mr-2" href="{{ route('routine.import') }}">
        <i class="fas fa-plus"></i> Import
      </a>
      <a class="btn btn-success btn-sm" href="{{ route('routine.create') }}">
        <i class="fas fa-plus"></i> Add Routine
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
          <th scope="col">Program</th>
          <th scope="col">Section</th>
          <th scope="col">Semester</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $routine)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td> {{ @$routine->faculty->title}}</td>
          <td> {{ @$routine->department->title}}</td>
          <td> {{ @$routine->program->title}}</td>
          <td> {{ @$routine->section->batch_number}} - {{ @$routine->section->section}}</td>
          <td> {{ @$routine->semester->title}}</td>

          <td>
            <a href="{{ route('routine.edit', $routine->id) }}" class="btn btn-light btn-sm me-2">
              <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('routine.destroy', $routine->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are You Sure You want To Delete?')">
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
          <td colspan="10" class="text-center">No data found</td>
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