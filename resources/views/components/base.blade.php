<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preload" href="/assets/fonts/poppins-v15-latin-regular.woff2" as="font" type="font/woff2" crossorigin="">
	<link rel="preload" href="/assets/fonts/poppins-v15-latin-600.woff2" as="font" type="font/woff2" crossorigin="">
	<link rel="preload" href="/assets/fonts/poppins-v15-latin-700.woff2" as="font" type="font/woff2" crossorigin="">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<title>Darts</title>
	<link rel="stylesheet" href="{{mix('/css/app.css')}}">
	<style>
		/* poppins-regular - latin */
	@font-face {
		font-family: "Poppins";
		font-style: normal;
		font-weight: 400;
		font-display: fallback;
		src: url("/assets/fonts/poppins-v15-latin-regular.eot"); /* IE9 Compat Modes */
		src: local(""),
			url("/assets/fonts/poppins-v15-latin-regular.eot?#iefix")
				format("embedded-opentype"),
			/* IE6-IE8 */ url("/assets/fonts/poppins-v15-latin-regular.woff2")
				format("woff2"),
			/* Super Modern Browsers */
				url("/assets/fonts/poppins-v15-latin-regular.woff")
				format("woff"),
			/* Modern Browsers */
				url("/assets/fonts/poppins-v15-latin-regular.ttf")
				format("truetype"),
			/* Safari, Android, iOS */
				url("/assets/fonts/poppins-v15-latin-regular.svg#Poppins")
				format("svg"); /* Legacy iOS */
	}
	/* poppins-600 - latin */
	@font-face {
		font-family: "Poppins";
		font-style: normal;
		font-weight: 600;
		font-display: fallback;
		src: url("/assets/fonts/poppins-v15-latin-600.eot"); /* IE9 Compat Modes */
		src: local(""),
			url("/assets/fonts/poppins-v15-latin-600.eot?#iefix")
				format("embedded-opentype"),
			/* IE6-IE8 */ url("/assets/fonts/poppins-v15-latin-600.woff2")
				format("woff2"),
			/* Super Modern Browsers */
				url("/assets/fonts/poppins-v15-latin-600.woff") format("woff"),
			/* Modern Browsers */ url("/assets/fonts/poppins-v15-latin-600.ttf")
				format("truetype"),
			/* Safari, Android, iOS */
				url("/assets/fonts/poppins-v15-latin-600.svg#Poppins")
				format("svg"); /* Legacy iOS */
	}
	/* poppins-700 - latin */
	@font-face {
		font-family: "Poppins";
		font-style: normal;
		font-weight: 700;
		font-display: fallback;
		src: url("/assets/fonts/poppins-v15-latin-700.eot"); /* IE9 Compat Modes */
		src: local(""),
			url("/assets/fonts/poppins-v15-latin-700.eot?#iefix")
				format("embedded-opentype"),
			/* IE6-IE8 */ url("/assets/fonts/poppins-v15-latin-700.woff2")
				format("woff2"),
			/* Super Modern Browsers */
				url("/assets/fonts/poppins-v15-latin-700.woff") format("woff"),
			/* Modern Browsers */ url("/assets/fonts/poppins-v15-latin-700.ttf")
				format("truetype"),
			/* Safari, Android, iOS */
				url("/assets/fonts/poppins-v15-latin-700.svg#Poppins")
				format("svg"); /* Legacy iOS */
	}
	</style>
	@stack('links')
	@stack('scripts')
</head>

<body class="antialiased max-w-md mx-auto p-3 flex flex-col">
	{{-- @if ('/'.Request::segment(1) != '/' || '/'.Request::segment(1) == '/play')
		<x-page-bar />
	@endif --}}

	<div class="h-full overflow-scroll">
		{{ $slot }}
	</div>

	<x-nav-bar />
</body>

</html>