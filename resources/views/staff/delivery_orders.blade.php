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
                <th>Order price</th>
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
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td id="price"></td>
                <td>$<span id="additional-price">{{ $order->additional_price }}</span></td>
                <td>$<span id="total-price">{{ $order->total_price }}</span></td>
                <td><button class="btn btn-success">Delivered</button></td>
            </tr>
            @endforeach
            <!-- Дополнительные строки можно добавить здесь -->
        </tbody>
    </table>
    <script>
        const price = document.querySelector('#price');
        const additional_price = parseInt(document.querySelector('#additional-price').textContent);
        const total_price = parseInt(document.querySelector('#total-price').textContent);

        price.textContent = '$' + (total_price - additional_price);
    </script>
</div>
@endsection