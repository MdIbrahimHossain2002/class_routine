@extends('layout')


@section('content')
<div class="container mt-5">
  <div class="row mb-4">
    <div class="col-md-6 d-flex align-items-center">
      <h3 class="mb-0">Faculty</h3>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
      <a class="btn btn-success btn-sm mr-2" href="{{ route('faculty.import') }}">
        <i class="fas fa-plus"></i> Import
      </a>
      <a class="btn btn-success btn-sm" href="{{ route('faculty.create') }}">
        <i class="fas fa-plus"></i> Add Faculty Name
      </a>
    </div>
  </div>

  @if($faculty->isNotEmpty())
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center align-middle">
        <thead class="">
          <tr>
            <th scope="col">SL</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($faculty as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->title }}</td>
              <td>
                <a href="{{ route('faculty.edit', $item->id) }}" class="btn btn-light btn-sm me-2">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('faculty.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are You Sure You want To Delete?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end">
      {!! $faculty->links() !!}
    </div>
  @else
    <div class="alert alert-info text-center">
      No faculty names found. Click the "Add Faculty Name" button to create a new entry.
    </div>
  @endif
</div>
@endsection
