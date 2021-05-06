<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{mix('/css/app.css')}}">
	<title>Darts</title>
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