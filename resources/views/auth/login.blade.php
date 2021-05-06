<x-base>
	<div class="w-full h-full px-4 flex flex-col justify-center items-center">

		<form id="login-form" action="{{route('login')}}" method="post" class="w-full flex flex-col items-center">
			@csrf

			<div class="flex flex-col w-full mb-2">
				<label for="email" class="mb-1 text-lg font-semibold text-blue-400">Email</label>
				<input type="email" id="email" name="email" value="{{old('email')}}" required autocomplete autofocus
					class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-xl">
				@error('email')
				<span class="text-red-500 text-sm">
					{{ $message }}
				</span>
				@enderror
			</div>

			<div class="flex flex-col w-full mb-2">
				<label for="password" class="mb-1 text-lg font-semibold text-blue-400">Wachtwoord</label>
				<input type="password" id="password" name="password" required autocomplete autofocus
					class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-xl">
				@error('password')
				<span class="text-red-500 text-sm">
					{{ $message }}
				</span>
				@enderror
			</div>

			<div class="flex items-center w-full mb-2">
				<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} class="mr-1 h-4 w-4 border-blue-500 text-blue-500">
				<label for="remember" class="text-blue-400 font-semibold">Onthou mij.</label>
			</div>

			<input type="submit" value="Inloggen" class="w-full font-semibold text-lg text-white p-2 rounded-lg shadow my-2 flex justify-center items-center bg-blue-500 select-none" />
		</form>

		<div class="flex flex-col w-full items-center">
			<a class="my-2" href="{{route('register')}}">
				Registreren
			</a>
		</div>
	</div>
</x-base>