@extends('client.layouts.main')

@section('title')
Register
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.make') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Name</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Your name" value="{{ old('username') }}">
                            @error('username')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your email" value="{{ old('email') }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone"><span class="text-danger">*</span> Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone number" value="{{ old('phone') }}">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address"><span class="text-danger">*</span> Address for delivery</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Your address" value="{{ old('address') }}">
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Your password">
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('user.login') }}">Alredy have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection