<template>
	<div class="mt-auto w-full">
		<input
			type="number"
			id="dart-id"
			:value="value"
			min=0
			max=180
			placeholder="Score"
			pattern="[0-9]*" 
			inputmode="numeric"
			@change="handleNumberInput($event.target)"
			class="w-full bg-gray-200 text-gray-700 font-bold placeholder-opacity-60 shadow-md placeholder-gray-400 py-2 px-4 mt-2 rounded-lg text-3xl"
		>
	</div>

</template>

<script>
export default {
	props: ['user', 'value'],
	methods: {

		handleNumberInput(target){
			let input_value = parseInt(target.value);
			if(this.scoreIsOutOfRange(target.min, target.max, input_value))
				return

			this.$emit('handleTurn', target)
		},

		scoreIsOutOfRange(min, max, score) {
			return score < min || score > max;
		}
	}
}
</script>