@extends('admin.layouts.main')

@section('title')
Users
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Users</h1>
    
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <th>
                    <form action="{{ route('user.delete', $user) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @error('delete')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection