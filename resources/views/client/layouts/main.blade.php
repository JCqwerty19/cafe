<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="{{ asset('storage/client/img/fav.png') }}">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>@yield('title')</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="{{ asset('storage/client/css/linearicons.css') }}">
	<link rel="stylesheet" href="{{ asset('storage/client/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('storage/client/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('storage/client/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('storage/client/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('storage/client/css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('storage/client/css/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('storage/client/css/main.css') }}">

	<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/57/4/common.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/57/4/util.js"></script>
</head>

<body>
	<header class="p-3 text-bg-dark">
    	<div class="container">
    	  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    	    	<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
    	      		<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
    	    	</a>

    	    	<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

    	      		<li><a href="{{ route('main.index') }}" class="btn btn-dark rounded-pill px-3">Home</a></li>
					@if (Auth::user())

					<li><a href="{{ route('order.create') }}" class="btn btn-warning rounded-pill px-3">Order</a></li>
					<li><a href="{{ route('user.orders') }}" class="btn btn-warning rounded-pill px-3">My orders</a></li>
					<li><a href="{{ route('user.update') }}" class="btn btn-warning rounded-pill px-3">Settings</a></li>
					<li>
						<form action="{{ route('user.logout') }}" method="POST">
							@csrf
							<button type="submit" class="btn btn-gray rounded-pill px-3">Logout</button>
						</form>
					</li>
    	    	</ul>

    	    	<div class="text-end">
				@else
					@yield('button')
				@endif
    	    	</div>
    	  	</div>
    	</div>
	</header>
	@section('button')
					<a href="{{ route('user.login') }}" type="button" class="btn btn-primary me-2">Login</a>
					@endsection
	@yield('content')
	<br><br><br><br><br><br><br><br>

	<!-- start footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
						Welcome to our Cafe, where we serve exceptional, sustainably
						sourced coffee in a warm and inviting atmosphere. Our skilled baristas craft
						each cup with passion, ensuring a delightful experience with every sip.
						</p>
						<p class="footer-text">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Cafe &copy;
							<script>document.write(new Date().getFullYear());</script> All rights reserved
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
					</div>
				</div>
				<div class="col-lg-5  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">
							<form target="_blank" novalidate="true"
								action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
								method="get" class="form-inline">
								<input class="form-control" name="EMAIL" placeholder="Enter Email"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									required="" type="email">
								<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right"
										aria-hidden="true"></i></button>
								<div style="position: absolute; left: -5000px;">
									<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
										type="text">
								</div>

								<div class="info pt-20"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 social-widget">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<script src="{{ asset('storage/client/js/vendor/jquery-2.2.4.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="{{ asset('storage/client/js/vendor/bootstrap.min.js') }}"></script>
	<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="{{ asset('storage/client/js/easing.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/hoverIntent.js') }}"></script>
	<script src="{{ asset('storage/client/js/superfish.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/jquery.sticky.js') }}"></script>
	<script src="{{ asset('storage/client/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/parallax.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/jquery.counterup.min.js') }}"></script>
	<script src="{{ asset('storage/client/js/mail-script.js') }}"></script>
	<script src="{{ asset('storage/client/js/main.js') }}"></script>
</body>

</html>