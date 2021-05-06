<x-base>

	<div class="w-full h-12 flex justify-between items-center border-b-2 border-blue-200">
		<div class="font-bold text-2xl">
			{{$user->name}}
		</div>
		<div>
			<svg class="icon fill-current">
				<use href="/assets/sprite.svg#settings"></use>
			</svg>
		</div>
	</div>

	<div class="my-3">
		<x-stats-block title="Gewonnen" :max="$user->total_games" :value="$user->total_games_won" />
		<x-stats-block title="Sets Gewonnen" :max="$user->total_sets" :value="$user->total_sets_won" />
		<x-stats-block title="Legs Gewonnen" :max="$user->total_legs" :value="$user->total_legs_won" />
	</div>


	<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
		href="{{route('logout')}}" class="font-semibold text-xl text-white p-3 rounded-lg shadow my-2 flex justify-center items-center bg-blue-500 select-none">Uitloggen</a>
	<form id="logout-form" action="{{route('logout')}}" method="post" class="hidden">
		@csrf
	</form>
</x-base>