@extends('staff.layouts.main')

@section('title')
Orders list
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Orders' list</h1>
    
        @foreach($orders as $order)
        <div class="card mb-3">

            <div class="card-header">
                <strong>Order number: #{{ $order->id }}</strong>
            </div>

            <div class="card-body">
                <strong>Customer name: </strong>{{ $order->customer_name }}
                <p><strong>Customer phone: </strong>{{ $order->customer_phone }}</p>
                <table class="table table-striped">
                <p><strong>Delivery: </strong>{{ $order->obtaining }}</p>
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
                    <form action="{{ route('distribution.distribute', $order) }}" method="POST">
                        @csrf
                        <button class="btn btn-success" type="submit">Issued</button>
                    </form>
                    <br><br>
                </table>
            </div>
            
        </div>
        @endforeach
        <br><br><br><br>
</div>
@endsection