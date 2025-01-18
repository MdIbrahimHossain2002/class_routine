@extends('layout')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">User List</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
