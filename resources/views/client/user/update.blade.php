@extends('client.layouts.main')

@section('title')
Update
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Update</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.renew') }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="username">Name</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Your name" value="{{ $user->username }}">
                            @error('username')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your email" value="{{ $user->email }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone"><span class="text-danger">*</span> Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone number" value="{{ $user->phone }}">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address"><span class="text-danger">*</span> Address for delivery</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Your address" value="{{ $user->address }}">
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
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection