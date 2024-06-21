@extends('staff.layouts.main')

@section('title')
Delivery orders
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">My deliveries</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Address</th>
                <th>Customer name</th>
                <th>Customer number</th>
                <th>Delivery price</th>
                <th>Total price</th>
                <th>Delivered</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->obtaining }}</td>
                <td>{{ $order->user->username }}</td>
                <td>{{ $order->user->phone }}</td>
                <td>$<span id="additional-price">{{ $order->additional_price }}</span></td>
                <td>$<span id="total-price">{{ $order->total_price }}</span></td>
                <td>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Delivered</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <!-- Дополнительные строки можно добавить здесь -->
        </tbody>
    </table>
</div>
@endsection