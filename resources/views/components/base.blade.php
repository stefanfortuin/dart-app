<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="/assets/favicon/site.webmanifest">
	<link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<title>Darts</title>
	<link rel="stylesheet" href="{{mix('/css/app.css')}}">
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