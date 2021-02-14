<x-base>
	<h1 class="font-bold text-4xl text-blue-500 mb-3">Spelers</h1>
	<div class="flex flex-col my-4">
		@foreach ($users as $user)
			<a href="{{'/stats/'.$user->id}}" class="text-2xl font-bold text-blue-500 my-2 px-3 py-4 border-2 border-blue-200 rounded-lg">
				{{$user->name}}
			</a>
		@endforeach
	</div>
	<a href="/" class="mt-auto h-20 bg-blue-500 text-white font-bold text-2xl rounded-lg my-2 flex justify-center items-center">Speel spel</a>
</x-base>