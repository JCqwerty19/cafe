@extends('client.layouts.main')

@section('title')
My orders
@endsection

@section('content')
<div class="container">
    <h1 class="my-4">Orders List</h1>

    @foreach($orders as $order)
        <div class="card mb-3">

            <div class="card-header">
                <strong>Order number: #{{ $order->id }}</strong> <br>
                <strong>Order status: {{ $order->status }}</strong>
            </div>

            <div class="card-body">
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
                    <form action="{{ route('order.delete', $order) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                    <br><br>
                </table>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @endforeach
</div>
    @endsection