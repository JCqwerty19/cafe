@extends('admin.layouts.main')

@section('title')
Admin Dashboard
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Admin Dashboard</h1>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Departments</h3>
            <div class="list-group">
                <a href="{{ route('kitchen.table') }}" class="list-group-item list-group-item-action">Kitchen</a>
                <a href="{{ route('pickup.table') }}" class="list-group-item list-group-item-action">Pickup</a>
                <a href="{{ route('delivery.table') }}" class="list-group-item list-group-item-action">Delivery</a>
                <a href="{{ route('hall.table') }}" class="list-group-item list-group-item-action">Hall</a>
                <a href="{{ route('courier.table') }}" class="list-group-item list-group-item-action">Couriers</a>
                <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action">Users</a>
            </div>
        </div>  

        <div class="col-md-6">
            <h3>Actions</h3>
            <div class="list-group">
                <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action">Products</a>
                <a href="{{ route('post.index') }}" class="list-group-item list-group-item-action">Posts</a>
            </div>
        </div>
    </div>
</div>
@endsection