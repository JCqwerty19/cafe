@extends('staff.layouts.main')

@section('title')
Login courier
@endsection

@section('button')
<a href="{{ route('courier.register') }}" type="button" class="btn btn-dark">Register</a>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('courier.signin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your email" value="{{ old('email') }}">
                            @error('email')
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
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('courier.register') }}">Have not an account? Register</a>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('courier.password.link') }}">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection