@extends('staff.layouts.main')

@section('title')
Reset password
@endsection

@section('button')
<a href="{{ route('courier.login') }}" type="button" class="btn btn-warning me-2">Login / Regiter</a>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Reset Password
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('courier.password.reset') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                            @error('password')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            @error('token')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection