<x-base>
	<h1 class="font-bold text-gray-700 text-4xl mb-4">{{$user->name}}</h1>
	<div class="flex flex-col">
		<h3 class="mb-1">Wedstrijden</h3>
		<x-stats-bar :total="$total_games" :won="$won" :lost="$lost" />

		<h3 class="mb-1">Sets</h3>
		<x-stats-bar :total="$total_sets" :won="$total_sets_won" :lost="$total_sets_lost" />
		<x-stats-block title="Gem. per beurt" :metric="$average_per_turn" />
		
	</div>
	<div class="mt-auto">
		<x-button-action href="/stats">Terug</x-button-action>
	</div>
</x-base>