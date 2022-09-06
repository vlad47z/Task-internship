<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="@yield('meta_description')">
	<meta name="keywords" content="HTML" />

	
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
	<body style="background-color: white">
		
			@include('include.navbar')
			<main>
				<div>
					@include('include.message')
					@yield('content')
					@include('include.footer')
				</div>
			</main>  
	
		

		<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
		<script>
		var options = {
			filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
			filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
			filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
			filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
		};
		</script>
		<script>
		CKEDITOR.replace('body', options);
		</script>


		<script>
            var route_prefix = "{{route('unisharp.lfm.show')}}";
            $('#lfm').filemanager('image', {prefix: route_prefix});
        </script>	
		
		<script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

		<!-- //load stand-alone-button -->
    	<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
		
		<!-- jquery -->
		<script src="{{ asset('assets/js/jquery-1.11.3.min.js')}}"></script>

		<!-- Fontawesome -->
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<!-- bootstrap -->
		<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
		<!-- count down -->
		<script src="{{ asset('assets/js/jquery.countdown.js')}}"></script>
		
		<!-- isotope -->
		<!-- <script src="{asset('assets/js/jquery.isotope-3.0.6.min.js')}"></script> -->
		
		<!-- waypoints -->
		<script src="{{asset('assets/js/waypoints.js')}}"></script>
		<!-- owl carousel -->
		<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
		<!-- magnific popup -->
		<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
		<!-- mean menu -->
		<script src="{{asset('assets/js/jquery.meanmenu.min.js')}}"></script>
		<!-- sticker js -->
		<script src="{{asset('assets/js/sticker.js')}}"></script>
		<!-- main js -->
		<script src="{{asset('assets/js/main.js')}}"></script>    
	</body>

</html>

