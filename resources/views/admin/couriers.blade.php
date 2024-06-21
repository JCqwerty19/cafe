@extends('admin.layouts.main')

@section('title')
Couriers
@endsection

@section('content')

<div class="container mt-5">
    <h1 class="text-center">Couriers</h1>
        
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($couriers as $courier)
            <tr>
                <td>{{ $courier->id }}</td>
                <td>{{ $courier->couriername }}</td>
                <td>{{ $courier->email }}</td>
                <td>{{ $courier->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection