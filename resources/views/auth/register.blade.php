<x-base>
	<div class="w-full h-full px-4 flex flex-col justify-center items-center">

			<form id="register-form" action="{{route('register')}}" method="post" class="w-full">
				@csrf

				<div class="flex flex-col mb-2">
					<label for="name" class="mb-1 text-lg font-semibold text-blue-400">Naam</label>
					<input type="name" id="name" name="name" value="{{old('name')}}" required autocomplete="name"
						autofocus class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-xl">
					@error('name')
					<span class="text-red-500 text-sm">
						{{ $message }}
					</span>
					@enderror
				</div>

				<div class="flex flex-col mb-2">
					<label for="email" class="mb-1 text-lg font-semibold text-blue-400">Email</label>
					<input type="email" id="email" name="email" value="{{old('email')}}" required autocomplete="email"
						autofocus class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-xl">
					@error('email')
					<span class="text-red-500 text-sm">
						{{ $message }}
					</span>
					@enderror
				</div>

				<div class="flex flex-col mb-2">
					<label for="password" class="mb-1 text-lg font-semibold text-blue-400">Wachtwoord</label>
					<input type="password" id="password" name="password" required
						class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-xl">
					@error('password')
					<span class="text-red-500 text-sm">
						{{ $message }}
					</span>
					@enderror
				</div>

				<div class="flex flex-col mb-2">
					<label for="password_confirmation" class="mb-1 text-lg font-semibold text-blue-400">Wachtwoord
						bevestigen</label>
					<input type="password" id="password_confirmation" name="password_confirmation" required
						class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-xl">
				</div>
			</form>

			<a onclick="event.preventDefault(); document.getElementById('register-form').submit();"
				href="{{route('register')}}"
				class="w-1/2 font-semibold text-lg text-white p-2 rounded-lg shadow my-2 flex justify-center items-center bg-blue-500 select-none">
				Registreren
			</a>
	</div>
</x-base>