<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Darts</title>
	<link rel="preconnect" type="font/woff2" as="font" href="/assets/fonts/poppins-v15-latin-regular.woff2">
	<link rel="preconnect" type="font/woff2" as="font" href="/assets/fonts/poppins-v15-latin-600.woff2">
	<link rel="preconnect" type="font/woff2" as="font" href="/assets/fonts/poppins-v15-latin-700.woff2">
	<link rel="stylesheet" href="{{mix('/css/app.css')}}">
	<link href="/assets/sprite.svg" as="image" type="image/svg+xml"/>
</head>

<body class="antialiased max-w-md mx-auto p-3 flex flex-col">
	{{-- @if ('/'.Request::segment(1) != '/' || '/'.Request::segment(1) == '/play')
		<x-page-bar />
	@endif --}}

	<div class="h-full overflow-scroll">
		{{ $slot }}
	</div>
		
	<x-nav-bar/>
</body>

</html>