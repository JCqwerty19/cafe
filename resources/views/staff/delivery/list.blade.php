@extends('staff.layouts.main')

@section('title')
My deliveries
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">My deliveries</h1>
        @foreach($orders as $order)
        <div class="card mb-3">

        <div class="card-header">
            <strong>Order number: #{{ $order->id }}</strong><br>

            <strong>Customer name: </strong>{{ $order->user->username }}

            <p><strong>Customer phone: </strong>{{ $order->user->phone }}</p>

            <br>

            <strong>
                <h6>Order price: $<span class="order-price"></span></h6>
            </strong>

            <strong>
                <h6 >Service price: $<span class="additional-price">{{ $order->additional_price }}</span></h6>
            </strong><br>

            <strong>
                <h3>Totla price: $<span class="total-price">{{ $order->total_price }}</span></h3>
            </strong><br>

            <form action="#" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Delivered</button>
            </form>
        </div>
    </div>
    @endforeach
    <!-- Дополнительные строки можно добавить здесь -->
</div>
@endsection


