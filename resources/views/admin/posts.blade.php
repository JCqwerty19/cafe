@extends('admin.layouts.main')

@section('title')
Posts
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Posts</h1>
    <a href="{{ route('post.create') }}" class="btn btn-success">Create post</a><br><br>
    <div class="list-group">
        @foreach($posts as $post)
         <a href="{{ route('post.read', $post) }}" class="list-group-item list-group-item-action">
            <h5 class="mb-1">{{ $post->title }}</h5>
            <p class="mb-1">{{ $post->content }}</p>
        </a><br>
        <a href="{{ route('post.update', $post) }}" class="btn btn-primary">Update</a><br>
        <form action="{{ route('post.delete', $post) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <br>
        @endforeach
    </div>
</div>
@endsection