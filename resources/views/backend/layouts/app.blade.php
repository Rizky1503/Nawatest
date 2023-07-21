<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>::eBazar:: @yield('title')</title>
	<link rel="icon" href="{{ url('/') }}/favicon.ico" type="image/x-icon"> <!-- Favicon-->
	<!-- datatabel -->
	<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

	@stack('styles')

	<!-- project css file  -->
	<link rel="stylesheet" href="{!! backendAssets('ebazar.style.min.css') !!}">

	@stack('custom_styles')
</head>

<body>
	<div id="ebazar-layout" class="theme-blue">

		@include(backendView('includes.sidebar'))

		<!-- main body area -->
		<div class="main px-lg-4 px-md-4">
			@php
				$auth = \Auth::user();
			@endphp
			
			@include(backendView('includes.header'))

			<!-- Body: Body -->
			<div class="body d-flex py-3">
				@yield('content')
			</div>

			@yield('footer')

		
			@stack('modals')

		</div>

	</div>

	<!-- Jquery Core Js -->
	<script src="{!! backendAssets('dist/assets/bundles/libscripts.bundle.js') !!}"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	@stack('scripts')
	<!-- Jquery Page Js -->
	<script src="{!! backendAssets('dist/assets/js/template.js') !!}"></script>
	@stack('custom_scripts')

</body>



</html>
