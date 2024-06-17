@extends('client.layouts.main')

@section('title')
Cafe
@endsection

@section('content')

<!-- start banner Area -->
<section class="banner-area" id="home">
	<div class="container">
		<div class="row fullscreen d-flex align-items-center justify-content-start">
			<div class="banner-content col-lg-7">
				<h6 class="text-white text-uppercase">Now you can feel the Energy</h6>
				<h1>
					Start your day with <br>
					a black Coffee
				</h1>
				<a href="#coffee" class="primary-btn text-uppercase">Buy Now</a>
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start video-sec Area -->
<section class="video-sec-area pb-100 pt-40" id="about">
	<div class="container">
		<div class="row justify-content-start align-items-center">
			<div class="col-lg-6 video-right justify-content-center align-items-center d-flex">
				<div class="overlay overlay-bg"></div>
				<a class="play-btn" href="https://www.youtube.com/watch?v=ARA0AxrnHdM"><img class="img-fluid"
						src="{{ asset('storage/client/img/play-icon.png') }}" alt=""></a>
			</div>
			<div class="col-lg-6 video-left">
				<h6>Live Coffee making process.</h6>
				<h1>We Telecast our <br>
					Coffee Making Live</h1>
				<p><span>We are here to listen from you deliver exellence</span></p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temp or incididunt ut
					labore et dolore magna aliqua. Ut enim ad minim.
				</p>
				<img class="img-fluid" src="{{ asset('storage/img/signature.png') }}" alt="">
			</div>
		</div>
	</div>
</section>
<!-- End video-sec Area -->

<!-- Start menu Area -->
<section class="menu-area section-gap" id="coffee">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="menu-content pb-60 col-lg-10">
				<div class="title text-center">
					<h1 class="mb-10">What kind of Coffee we serve for you</h1>
					<p>Who are in extremely love with eco friendly system.</p>
				</div>
			</div>
		</div>
		<div class="row">
		@foreach($products as $product)
				<div class="col-lg-4">
					<div class="single-menu">
						<div class="title-div justify-content-between d-flex">
							<a href="{{ route('order.create') }}"><h4>{{ $product->name }}</h4></a>
							<p class="price float-right">
								${{ $product->price }}
							</p>
						</div>
						<p>
							{{ $product->content }}
						</p>
					</div>
				</div>
		@endforeach
		</div>
	</div>
</section>
<!-- End menu Area -->

<!-- Start gallery Area -->
<section class="gallery-area section-gap" id="gallery">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="menu-content pb-60 col-lg-10">
				<div class="title text-center">
					<h1 class="mb-10">What kind of Coffee we serve for you</h1>
					<p>Who are in extremely love with eco friendly system.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<a href="{{ asset('storage/client/img/g1.jpg') }}" class="img-pop-home">
					<img class="img-fluid" src="{{ asset('storage/client/img/g1.jpg') }}" alt="">
				</a>
				<a href="{{ asset('storage/client/img/g2.jpg') }}" class="img-pop-home">
					<img class="img-fluid" src="{{ asset('storage/client/img/g2.jpg') }}" alt="">
				</a>
			</div>
			<div class="col-lg-8">
				<a href="{{ asset('storage/client/img/g3.jpg') }}" class="img-pop-home">
					<img class="img-fluid" src="{{ asset('storage/client/img/g3.jpg') }}" alt="">
				</a>
				<div class="row">
					<div class="col-lg-6">
						<a href="{{ asset('storage/client/img/g4.jpg') }}" class="img-pop-home">
							<img class="img-fluid" src="{{ asset('storage/client/img/g4.jpg') }}" alt="">
						</a>
					</div>
					<div class="col-lg-6">
						<a href="{{ asset('storage/client/img/g5.jpg') }}" class="img-pop-home">
							<img class="img-fluid" src="{{ asset('storage/client/img/g5.jpg') }}" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End gallery Area -->

<!-- Start blog Area -->
<section class="blog-area section-gap" id="blog">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="menu-content pb-60 col-lg-10">
				<div class="title text-center">
					<h1 class="mb-10">What kind of Coffee we serve for you</h1>
					<p>Who are in extremely love with eco friendly system.</p>
				</div>
			</div>
		</div>
		<div class="row">
			@foreach($posts as $post)
			<div class="col-lg-6 col-md-6 single-blog">
				<img class="img-fluid" src="{{ asset('client/img/b1.jpg') }}" alt="">
				<ul class="post-tags">
					<li><a href="#">Travel</a></li>
					<li><a href="#">Life Style</a></li>
				</ul>
				<a href="#">
					<h4>{{ $post->title }}</h4>
				</a>
				<p>
					{{ $post->content }}
				</p>
				<p class="post-date">
					31st January, 2018
				</p>
			</div>
			@endforeach
		</div>
	</div>
</section>
<!-- End blog Area -->

@endsection