<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website')</title>

    
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="{{asset('contents/frontend')}}/common-css/bootstrap.css" rel="stylesheet">
	<link href="{{asset('contents/frontend')}}/common-css/swiper.css" rel="stylesheet">
	<link href="{{asset('contents/frontend')}}/common-css/ionicons.css" rel="stylesheet">
	<link href="{{asset('contents/backend')}}/toastr/toastr.min.css" rel="stylesheet" />
    @stack('css')
</head>
<body >

	<header>
		<div class="container-fluid position-relative no-side-padding">

        <a href="{{url('/')}}" class="logo"><img src="{{asset('contents/frontend')}}/images/logo.png" alt="Logo Image"></a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{route('website')}}">Home</a></li>
				<li><a href="{{route('post.index')}}">Posts</a></li>
				@guest
				<li><a href="{{route('login')}}">Log In</a></li>
				@else
					@if(Auth::user()->role->id == 1)
					<li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
					@endif
					@if(Auth::user()->role->id == 2)
					<li><a href="{{route('author.dashboard')}}">Dashboard</a></li>
					@endif
				@endguest
            
			</ul><!-- main-menu -->

			<div class="src-area">
				<form method="get" action="{{route('search')}}">
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" value="{{isset($query) ? $query:''}}" name="search" type="text" placeholder="Type of search">
				</form>
			</div>

		</div><!-- conatiner -->
	</header>

    @yield('content')

	<footer>

		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<a class="logo" href="{{url('/')}}"><img src="{{asset('contents/frontend')}}/images/logo.png" alt="Logo Image"></a>
						<p class="copyright">Bona @ 2017. All rights reserved.</p>
						<p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
						<ul class="icons">
							<li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
						</ul>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">

				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4>
						<div class="input-area">
							<form method="post" action="{{route('subscriber.store')}}">
								@csrf
								<input class="email-input" name="email" type="email" placeholder="Enter your email">
								<button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
							</form>
						</div>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

			</div><!-- row -->
		</div><!-- container -->
	</footer>

	<!-- SCIPTS -->
	<script src="{{asset('contents/frontend')}}/common-js/jquery-3.1.1.min.js"></script>
	<script src="{{asset('contents/frontend')}}/common-js/tether.min.js"></script>
	<script src="{{asset('contents/frontend')}}/common-js/bootstrap.js"></script>
	<script src="{{asset('contents/frontend')}}/common-js/swiper.js"></script>
	<script src="{{asset('contents/frontend')}}/common-js/scripts.js"></script>
	<script src="{{asset('contents/backend')}}/toastr/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{$error}}','Error',{
                    closeButton:true,
                    progressBar:true,
                });
            @endforeach
        @endif

    </script>
    stack('js')
</body>
</html>
