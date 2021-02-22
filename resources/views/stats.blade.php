<x-base>
	<h1 class="font-bold text-4xl text-gray-700 mb-3">Statistieken</h1>
	<div class="flex flex-col my-4">
		@foreach ($users as $user)
			<a href="{{'/stats/'.$user->id}}" class="text-2xl font-bold text-white my-1 px-4 py-3 bg-gradient-to-br from-blue-600 to-blue-500 rounded-lg">
				{{$user->name}}
			</a>
		@endforeach
	</div>
	<a href="/" class="mt-auto p-4 bg-gradient-to-br from-blue-600 to-blue-500 text-white font-bold text-2xl rounded-lg my-1 flex justify-center items-center">Terug</a>
</x-base>