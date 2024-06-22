@extends('staff.layouts.main')

@section('title')
Settings
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('delivery.renew') }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="couriername">Name</label>
                            <input type="text" class="form-control" name="couriername" id="couriername" placeholder="Your name" value="{{ $courier->couriername }}">
                            @error('couriername')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your email" value="{{ $courier->email }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone"><span class="text-danger">*</span> Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone number" value="{{ $courier->phone }}">
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
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>

            <br><br>
            <p class="text-danger">Delete account</p>
            <form action="{{ route('courier.delete', $courier) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn-danger btn" type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection