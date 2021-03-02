<template>
	<div class="px-2 py-2 font-light text-lg text-blue-500 ">
		<div class="flex justify-between items-baseline">
			<div class="">
				Game of <span class="font-medium">x01</span>
			</div>
			<div
				@click="showDropdown = !showDropdown"
				class="px-3 py-1 shadow-md flex justify-evenly items-center w-40 transition-all bg-blue-500 text-white"
				:class="(showDropdown) ? 'rounded-t-lg' : 'rounded-lg'"
			>
				<div class="pr-1">Sets and legs</div>
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
		</div>
		<transition name="normal-fade">
			<div v-if="showDropdown" class="flex justify-between">
				<div class="text-base">
					<div>Totaal <span class="font-semibold">{{total_sets}}</span> sets.</div>
					<div>Totaal <span class="font-semibold">{{total_legs}}</span> legs.</div>
				</div>
				<div class="table p-2 w-40 shadow-md bg-blue-500 text-white rounded-b-lg">
					<div class="table-row-group">
						<div class="table-row">
							<div class="table-cell"></div>
							<div class="table-cell text-center">Sets</div>
							<div class="table-cell text-center">Legs</div>
						</div>
						<div
							v-for="user in users"
							:key="user.id"
							class="table-row"
						>
							<div class="table-cell">{{user.name}}</div>
							<div class="table-cell text-center">{{user.sets_won}}</div>
							<div class="table-cell text-center">{{user.legs_won}}</div>
						</div>
					</div>
				</div>
			</div>
		</transition>

	</div>
</template>

<script>
import { mapState } from 'vuex';

export default {
	data() {
		return {
			showDropdown: false,
		}
	},
	computed: {
		...mapState({
			users: state => state.users,
			total_sets: state => state.total_sets,
			total_legs: state => state.total_legs,
		})
	}
}
</script>