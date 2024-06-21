@extends('staff.layouts.main')

@section('title')
Kitchen
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Orders</h1>
    
        @foreach($orders as $order)
        

        <div class="card mb-3">

            <div class="card-header">
                <strong>Order number: #{{ $order->id }}</strong><br>
                <strong>Customer name: </strong>{{ $order->user->username }}
                <p><strong>Customer phone: </strong>{{ $order->user->phone }}</p>
                <br>
                <strong>
                     <h6>Order price: $<span id="order-price"></span></h6>
                </strong>
                <strong>
                     <h6 >Service price: $<span id="additional-price">{{ $order->additional_price }}</span></h6>
                </strong><br>
                <strong>
                    <h3>Totla price: $<span id="total-price">{{ $order->total_price }}</span></h3>
                </strong>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                
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
                    <form action="{{ route('order.distribute', $order) }}" method="POST">
                        @csrf
                        <button class="btn btn-success" type="submit">Issued</button>
                    </form>
                    
                    <br><br>
                </table>   
            </div>
        </div>

        @include('client.includes.order_scripts')
        
        @endforeach

        

        <br><br><br><br>
</div>
@endsection