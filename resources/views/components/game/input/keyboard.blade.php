<div>
	<div>
		{{$score}}
	</div>
	<div x-data="{ score: ''}" class="relative grid grid-rows-4 grid-cols-3 w-full h-full min-h-32 max-h-52 gap-1">

		{{-- <transition name="custom-score">
			<div v-if="score.length > 0" class="absolute w-full flex justify-start items-center z-50 px-2"
				style="top: -3.4rem">
				<div class="px-2 py-1 bg-blue-100 text-blue-800 font-semibold text-2xl rounded h-full">
					{{ formattedScore }}
				</div>
			</div>
		</transition> --}}

		@for ($i = 1; $i < 10; $i++) <div wire:key="'num-' . {{$i}}" wire:click="addNumberToScore('{{$i}}')"
			class="flex justify-center items-center max-h-12 text-blue-800 bg-blue-100 active:bg-blue-500 active:text-white font-semibold text-2xl rounded z-20">
			{{ $i }}
	</div>
	@endfor

	<div wire:click="clearScore"
		class="rounded flex justify-center items-center max-h-12 bg-blue-100 active:bg-blue-500 active:text-white text-blue-900">
		<svg class="icon">
			<use href="/assets/sprite.svg#backspace"></use>
		</svg>
	</div>
	<div wire:click="addNumberToScore('0')"
		class="flex justify-center items-center max-h-12 text-blue-800 bg-blue-100 active:bg-blue-400 font-semibold text-2xl rounded">
		0
	</div>
	<div wire:click="makeTurn"
		class="rounded flex justify-center items-center max-h-12 bg-blue-500 active:bg-blue-600 text-white">
		<svg class="icon">
			<use href="/assets/sprite.svg#arrow-right"></use>
		</svg>
	</div>
</div>
</div>