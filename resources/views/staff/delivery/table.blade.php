@extends('staff.layouts.main')

@section('title')
Delivery list
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Deliver list</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Address</th>
                <th>Delivery price</th>
                <th>Total price</th>
                <th>Deliver</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->obtaining }}</td>
                <td>$<span id="additional-price">{{ $order->additional_price }}</span></td>
                <td>$<span id="total-price">{{ $order->total_price }}</span></td>
                <td>
                    <form action="{{ route('delivery.deliver', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Deliver</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection