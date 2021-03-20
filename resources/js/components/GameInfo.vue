<template>
	<div class="px-2 py-2 font-light text-lg text-blue-500 ">
		<div class="flex justify-between items-baseline">
			<div class="">
				<div>
					
				</div>
				<div
					v-if="showDropdown"
					class="text-lg h-full"
				>
					<div>Totaal <span class="font-semibold">{{total_sets}}</span> sets.</div>
					<div>Totaal <span class="font-semibold">{{total_legs}}</span> legs.</div>
				</div>
			</div>
			<div
				@click="showDropdown = !showDropdown"
				class="px-3 py-1 flex flex-col justify-evenly items-center w-40 bg-blue-500 text-white rounded-lg"
			>
				<div class="flex justify-evenly items-center">
					<div class="pr-2">Sets and legs</div>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						class="h-6 w-6 transition-transform transform"
						:class="(showDropdown) ? 'rotate-180' : ''"
						viewBox="0 0 24 24"
						stroke="currentColor"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M19 9l-7 7-7-7"
						/>
					</svg>
				</div>
				<sets-and-legs-table v-if="showDropdown" />
			</div>
		</div>

	</div>
</template>

<script>
import { mapState } from 'vuex';
import SetsAndLegsTable from './SetsAndLegsTable.vue';

export default {
	data() {
		return {
			showDropdown: false
		}
	},
	components: {
		SetsAndLegsTable,
	},
	computed: {
		...mapState({
			users: state => state.users,
			total_sets: state => state.total_sets,
			total_legs: state => state.total_legs,
			leg_owner: state => state.current_leg_owner,
		})
	}
}
</script>