@extends('client.layouts.main')

@section('title')
{{ $post->title }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ asset($post->image) }}" alt=""><br>
                <div class="card-header text-center">
                    <h3 id="post-title">{{ $post->title }}</h3>
                </div>
                <div class="card-body">
                    <p id="post-content">
                        {{ $post->content }}
                    </p>
                </div>
                <div class="card-footer text-right">
                    <button onclick="window.history.back()" class="btn btn-secondary">Back</button>
                </div>
            </div>
            <!-- Слайдер других постов -->
            <div id="relatedPostsCarousel" class="carousel slide mt-4" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($posts as $post)
                    <div class="carousel-item">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">Краткое описание поста 2...</p>
                                <a href="{{}}" class="btn btn-primary">Read</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#relatedPostsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#relatedPostsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection