@extends('staff.layouts.main')

@section('title')
Cafe orders
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Список заказов</h1>
    
        @foreach($orders as $order)
        <div class="card mb-3">

            <div class="card-header">
                <strong>Customer name:</strong> {{ $order->customer_name }}
            </div>

            <div class="card-body">
                <p><strong>Customer phone:</strong>{{ $order->customer_phone }}</p>
                <table class="table table-striped">
                <p><strong>Delivery:</strong>{{ $order->obtaining }}</p>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_id }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <button class="btn btn-success">Issued</button>
                    <br><br>
                </table>
            </div>
            
        </div>
        @endforeach
        <br><br><br><br>
</div>
@endsection