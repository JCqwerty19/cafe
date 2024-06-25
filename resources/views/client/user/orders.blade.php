@extends('client.layouts.main')

@section('title')
My orders
@endsection

@section('content')
<div class="container">
    <h1 class="my-4">My orders</h1>
    @error('delete')
        <p class="text-danger">{{ $message }}</p> 
    @enderror
    @foreach($orders as $order)
        <div class="card mb-3">

            <div class="card-header">
                <strong>Order number: #{{ $order->id }}</strong><br>
                <strong>Order status: {{ $order->status }}</strong><br>
                <strong>Delivery: {{ $order->obtaining }} </strong><br>
                <strong >Courier phone: 
                    @if($order->delivery && $order->delivery->courier)
                        +{{ $order->delivery->courier->phone }}
                    @else
                        Not declared
                    @endif
                </strong><br>
                <strong>
                     <h6>Order price: $<span class="order-price"></span></h6>
                </strong>
                <strong>
                     <h6 >Service price: $<span class="additional-price">{{ $order->additional_price }}</span></h6>
                </strong><br>
                <strong>
                    <h3>Totla price: $<span class="total-price">{{ $order->total_price }}</span></h3>
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
                    <form action="{{ route('order.delete', $order) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                    
                    <br><br>
                </table>   
            </div>
        </div>
        @endforeach

        @include('client.includes.order_scripts')
</div>
@endsection

