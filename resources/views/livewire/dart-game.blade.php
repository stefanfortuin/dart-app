<div x-data="{step: @entangle('currentStep')}">
	<x-game.settings :users="$users" :startingUser="$startingUser"/>
	<x-game.board />
	<x-game.end />
</div>