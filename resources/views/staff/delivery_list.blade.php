@extends('staff.layouts.main')

@section('title')
Deliver list
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Deliver list</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Address</th>
                <th>Order price</th>
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
                <td id="price"></td>
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
    <script>
        const price = document.querySelector('#price');
        const additional_price = parseInt(document.querySelector('#additional-price').textContent);
        const total_price = parseInt(document.querySelector('#total-price').textContent);

        price.textContent = '$' + (total_price - additional_price);
    </script>
</div>
@endsection