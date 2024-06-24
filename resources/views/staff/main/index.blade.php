@extends('staff.layouts.main')

@section('title')
Become a courier
@endsection

@section('content')
<div class="text-center">
    <h1 class="mb-4">Become a Courier</h1>
    <a href="{{ route('courier.register') }}" class="btn btn-primary btn-lg mb-3">Register</a>
    <div>
        <p>Already working with us?</p>
        <a href="{{ route('courier.login') }}" class="btn btn-secondary btn-lg">Login</a>
    </div>
</div>
@endsection