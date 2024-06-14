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
	<header id="header" id="home">
		<div class="header-top">
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
						<ul>
							<li>
								Mon-Fri: 8am to 2pm
							</li>
							<li>
								Sat-Sun: 11am to 4pm
							</li>
							<li>
								<a href="tel:(012) 6985 236 7512">(012) 6985 236 7512</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="index.html"><img src="{{ asset('storage/client/img/logo.png') }}" alt="" title="" /></a>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li class="menu-active"><a href="#home">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#coffee">Coffee</a></li>
						<li><a href="#blog">Blog</a></li>
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header><!-- #header -->

	@yield('content')

	<!-- start footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
						Welcome to our Coffee Cafe, where we serve exceptional, sustainably
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
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="{{ asset('storage/client/js/order-table.js') }}"></script>
	<script src="{{ asset('storage/client/js/order-form.js') }}"></script>
</body>

</html>