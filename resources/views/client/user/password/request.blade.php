@extends('client.layouts.main')

@section('title')
Forgot password
@endsection

@section('button')
<a href="{{ route('user.login') }}" type="button" class="btn btn-warning me-2">Login / Regiter</a>
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Password Reset</h2>
    <p class="text-center">Please enter your email address to receive a link to reset your password.</p>
    <form action="{{ route('user.password.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        @error('email')
        <p class="alert alert-danger">{{ $message }}</p>
        @enderror

        @if (session('message'))
        <p class="alert alert-success">{{ session('message') }}</p>
        @endif
        <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
    </form>
</div>
@endsection