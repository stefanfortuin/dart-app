<div x-data="{step: @entangle('currentStep')}">
	<x-game.settings :users="$users" :startingUser="$startingUser"/>
	<x-game.board :game="$game" :users="$users" :score="$score" />
	<x-game.end />
</div>