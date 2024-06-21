@extends('staff.layouts.main')

@section('title')
Register courier
@endsection

@section('button')
<a href="{{ route('delivery.login') }}" type="button" class="btn btn-dark">Login</a>
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
                    <form action="{{ route('delivery.make') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="couriername">Name</label>
                            <input type="text" class="form-control" name="couriername" id="couriername" placeholder="Your name" value="{{ old('couriername') }}">
                            @error('couriername')
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
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone number" value="{{ old('phone') }}">
                            @error('phone')
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
                    @error('account')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <a href="{{ route('delivery.login') }}">Alredy have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection