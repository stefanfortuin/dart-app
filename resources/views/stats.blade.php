<x-base>
	<h1 class="font-bold text-4xl text-gray-700 mb-3">Statistieken</h1>
	<div class="flex flex-col my-4">
		@foreach ($users as $user)
			<a href="{{'/stats/'.$user->id}}" class="text-2xl font-bold text-white my-1 px-4 py-3 bg-blue-500 rounded-lg">
				{{$user->name}}
			</a>
		@endforeach
	</div>
	<div class="mt-auto">
		<x-button-action href="/">Terug</x-button-action>
	</div>
</x-base>