<div x-show="step == 0" x-transition.duration.500ms>
    <x-input.text wire:model.lazy="users.0" :label="'Speler 1'" :id="'player_one'" />
	<x-input.text wire:model.lazy="users.1" :label="'Speler 2'" :id="'player_two'" />

	<x-input.number wire:model.defer="startScore" :id="'start_score'" :label="'Start score'" :max="501" :min="101" />

	<div class="grid grid-cols-2 gap-2 w-full">
		<x-input.number wire:model.defer="totalSets" :id="'sets_amount'" :label="'Sets'" min="1" />
		<x-input.number wire:model.defer="totalLegs" :id="'legs_amount'" :label="'Legs/set'" min="1" />
	</div>

	<x-input.button wire:click="goToNextStep">
		Start spel
	</x-input.button>
</div>
