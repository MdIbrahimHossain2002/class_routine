@extends('layout')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6 d-flex align-items-center">
                <h3 class="mb-0">User List</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-success btn-sm" href="{{ route('user.create') }}">
                    <i class="fas fa-plus"></i> Add User
                </a>
            </div>
        </div>

        @if ($user->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $data->id) }}" class="btn btn-light btn-sm me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $data->id) }}" method="POST" class="d-inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete?')">
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
                {!! $user->links() !!}
            </div>
        @else
            <div class="alert alert-info text-center">
                No users found. Click the "Add User" button to create a new entry.
            </div>
        @endif
    </div>
@endsection
