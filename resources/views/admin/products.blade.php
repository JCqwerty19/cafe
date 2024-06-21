@extends('admin.layouts.main')

@section('title')
Products
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Products</h1>
    <a href="{{ route('product.create') }}" class="btn btn-success">Create product</a><br><br>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->content }}</p>
                    <p class="card-text"><strong>${{ $product->price }}</strong></p>
                </div><br>
                <a href="{{ route('product.update', $product) }}" class="btn btn-primary">Update</a><br>
                <form action="{{ route('product.delete', $product) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <br>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection