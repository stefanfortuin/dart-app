<x-base>
	<div class="flex flex-col">
		@foreach ($users as $user)
			<a href="{{'/stats/'.$user->id}}" class="text-2xl font-bold text-white my-1 px-4 py-3 bg-blue-500 rounded-lg">
				<x-user-name name="{{$user->name}}" />
			</a>
		@endforeach
	</div>
</x-base>