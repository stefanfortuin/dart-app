<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<svg width="0" height="0" class="hidden">
		<symbol xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="backspace">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
				d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z">
			</path>
		</symbol>
		<symbol xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="check">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
		</symbol>
	</svg>
	<link rel="stylesheet" href="{{mix('/css/app.css')}}">
	<title>Darts</title>
</head>

<body class="font-sans antialiased max-w-md mx-auto p-4 flex flex-col">
	{{ $slot }}
</body>

</html>