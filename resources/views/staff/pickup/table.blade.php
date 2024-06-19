@extends('staff.layouts.main')

@section('title')
Delivery orders
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Orders for pick up</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer name</th>
                <th>Customer number</th>
                <th>Total price</th>
                <th>Picked up</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>${{ $order->total_price }}</td>
                <td>
                    <form action="{{ route('order.close', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Picked up</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <!-- Дополнительные строки можно добавить здесь -->
        </tbody>
    </table>
</div>
@endsection