<x-base>

	<div class="w-full h-12 flex justify-between">
		<div class="font-bold text-2xl">
			{{$user->name}}
		</div>
		<div>
			<svg class="icon fill-current">
				<use href="/assets/sprite.svg#settings"></use>
			</svg>
		</div>
	</div>

	<div>
		<h3 class="mb-3 font-bold text-lg">Statistieken</h3>
		<div class="grid grid-cols-2 grid-rows-2 gap-2">
			<x-stats-block title="Gewonnen" :metric="$user->total_games_won" />
			<x-stats-block title="Sets" :metric="$user->total_sets_won" />
			<x-stats-block title="Legs" :metric="$user->total_legs_won" />
			<x-stats-block title="Total Sets" :metric="$user->total_sets" />
			<x-stats-block title="Total Legs" :metric="$user->total_legs" />
		</div>
	</div>



	<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
		href="{{route('logout')}}" class="font-semibold text-xl text-white p-3 rounded-lg shadow my-2 flex justify-center items-center bg-blue-500 select-none">Uitloggen</a>
	<form id="logout-form" action="{{route('logout')}}" method="post" class="hidden">
		@csrf
	</form>
</x-base>