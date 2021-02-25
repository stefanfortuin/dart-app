<x-base>
	<h1 class="font-bold text-gray-700 text-4xl mb-4">{{$user->name}}</h1>
	<div class="grid grid-cols-2 gap-2 overflow-y-scroll">
		<x-stats-block title="Wedstrijden" :metric="$total_games" />
		<x-stats-block title="Gem/beurt" :metric="$average_per_turn" />
		<x-stats-block title="Gewonnen" :metric="$won" />
		<x-stats-block title="Verloren" :metric="$lost" />
	</div>
	<div class="mt-auto">
		<x-button-action href="/stats">Terug</x-button-action>
	</div>
</x-base>