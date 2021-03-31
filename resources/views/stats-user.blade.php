<x-base>
	<h1 class="font-bold text-gray-700 text-4xl mb-4">{{$user->name}}</h1>
	<div class="flex flex-col">
		<x-stats-block title="Wedstrijden" :metric="$total_games" />
		<x-stats-block title="Wedstrijden gewonnen" :metric="$won" />
		<x-stats-block title="Wedstrijden verloren" :metric="$lost" />
		<x-stats-block title="Totaal sets" :metric="$total_sets" />
		<x-stats-block title="Sets gewonnen" :metric="$total_sets_won" />
		<x-stats-block title="Sets verloren" :metric="$total_sets_lost" />
		<x-stats-block title="Gem. per beurt" :metric="$average_per_turn" />
		
	</div>
	<div class="mt-auto">
		<x-button-action href="/stats">Terug</x-button-action>
	</div>
</x-base>