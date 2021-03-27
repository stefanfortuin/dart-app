<template>
	<div class="px-2 pb-2 rounded-b-lg h-full text-lg text-white bg-blue-500">
		<div class="text-lg">
			<div>Totaal <span class="font-semibold">{{total_sets}}</span> sets.</div>
			<div>Totaal <span class="font-semibold">{{total_legs}}</span> legs.</div>
		</div>
		<sets-and-legs-table />
	</div>
	
</template>

<script>
import { mapState } from 'vuex';
import SetsAndLegsTable from '../Info/SetsAndLegsTable.vue';

export default {
	name: 'game-info',
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