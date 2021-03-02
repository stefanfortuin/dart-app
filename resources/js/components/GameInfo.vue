<template>
	<div class="px-2 py-2 font-light text-lg text-blue-500 ">
		<div class="flex justify-between items-baseline">
			<div class="">
<<<<<<< HEAD
				<div>
					Game of <span class="font-medium">x01</span>
				</div>
				<div
					v-if="showDropdown"
					class="text-lg h-full"
=======
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
>>>>>>> 7792dd83ec2457132a7485a27d60e144bf78cb17
				>
					<div>Totaal <span class="font-semibold">{{total_sets}}</span> sets.</div>
					<div>Totaal <span class="font-semibold">{{total_legs}}</span> legs.</div>
				</div>
<<<<<<< HEAD
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
=======
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
>>>>>>> 7792dd83ec2457132a7485a27d60e144bf78cb17
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
		})
	}
}
</script>