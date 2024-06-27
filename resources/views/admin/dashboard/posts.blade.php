@extends('admin.layouts.main')

@section('title')
Posts
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">posts</h1>
    <a href="{{ route('post.create') }}" class="btn btn-success">Create post</a><br><br>
    <div class="row">
        @foreach($posts as $post)
        <a href="{{ route('post.read', $post) }}">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->name }}">
                    <div class="card-body">

                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                    </div><br>
                    <a href="{{ route('post.update', $post) }}" class="btn btn-primary">Update</a><br>
                    <form action="{{ route('post.delete', $post) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <br>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection