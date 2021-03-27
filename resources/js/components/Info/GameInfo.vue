<template>
	<div class="h-full text-lg text-white bg-blue-500">
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