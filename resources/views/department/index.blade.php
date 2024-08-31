@extends('layout')


@section('content')
<div class="container mt-5">
  <div class="row mb-4">
    <div class="col-md-6 d-flex align-items-center">

      <h3 class="mb-0">Department</h3>

    </div>
    <div class="col-md-6 d-flex justify-content-end">
      <a class="btn btn-success btn-sm" href="{{ route('department.create') }}">
        <i class="fas fa-plus"></i> Add Department
      </a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center align-middle">
      <thead >
        <tr>
          <th scope="col">SL</th>
          <th scope="col">Faculty</th>     
          <th scope="col">Department</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $department)
          <tr>
          <td>{{ $loop->iteration }}</td>
          <td> {{ @$department->faculty->title}}</td>           
            <td>{{ $department->title }}</td>
            <td>
              <a href="{{ route('department.edit', $department->id) }}" class="btn btn-light btn-sm me-2">
                <i class="fas fa-edit"></i> Edit
              </a>
              <form action="{{ route('department.destroy', $department->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are You Sure You want To Delete?')">
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
            <td colspan="3" class="text-center">No data found</td>
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
