@extends('staff.layouts.main')

@section('title')
Hall orders
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Orders</h1>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Order number</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection