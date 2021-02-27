<template>
	<div class="px-3 py-2 font-light rounded-t-lg text-lg bg-blue-100 text-blue-500 flex justify-between items-baseline">
		<div class="">
			Game of <span class="font-medium">x01</span>
		</div>
		<div class="flex flex-grow justify-end text-base">
			<div class="pl-4">
				Sets {{total_sets}}
			</div>
			<div class="pl-4">
				Legs {{total_legs}}
			</div>
		</div>
	</div>
</template>

<script>
import { mapState } from 'vuex';

export default {
	computed: {
		...mapState({
			current_set: state => state.current_set,
			current_leg: state => state.current_leg,
			total_sets: state => state.total_sets,
			total_legs: state => state.total_legs,
		})
	}
}
</script>