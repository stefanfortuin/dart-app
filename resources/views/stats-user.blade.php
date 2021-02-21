<x-base>
	<h1 class="font-bold text-gray-700 text-4xl mb-4">{{$user->name}}</h1>
	<div class="grid grid-cols-2 gap-2 overflow-y-scroll">
		<x-stats-block title="Wedstrijden" :metric="$total_games"/>
		<x-stats-block title="Gem/beurt" :metric="$average_per_turn"/>
		<x-stats-block title="Gewonnen" :metric="$won"/>
		<x-stats-block title="Verloren" :metric="$lost"/>
	</div>
	<a href="/stats" class="my-2 font-bold h-20 bg-blue-500 text-white flex justify-center items-center text-2xl rounded-lg mt-auto">Terug</a>
</x-base>