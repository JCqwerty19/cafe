@extends('staff.layouts.main')

@section('title')
Hall orders
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Hall orders</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer name</th>
                <th>Customer number</th>
                <th>Order price</th>
                <th>Service price 10%</th>
                <th>Total price</th>
                <th>Served</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->username }}</td>
                <td>{{ $order->user->phone }}</td>
                <td id="price"></td>
                <td>$<span id="additional-price">{{ $order->additional_price }}</span></td>
                <td>$<span id="total-price">{{ $order->total_price }}</span></td>
                <td>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Served</button>
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