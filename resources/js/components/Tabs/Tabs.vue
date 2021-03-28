<template>
	<div class="w-full flex-grow flex flex-col my-4">
		<div class="w-full flex">
			<div
				v-for="(tab,index) in tabs"
				:key="index"
				@click="selectTab(index)"
				class="w-1/2 py-1 text-center text-lg text-white font-semibold first:rounded-tl-lg last:rounded-tr-lg"
				:class="index == selected_index ? 'bg-blue-500 ' : 'bg-blue-200'"
			>
				{{tab}}
			</div>
		</div>
		<div class="flex-grow max-h-64 p-1 px-2 bg-blue-500 rounded-b-lg">
			<keep-alive>
				<graph-turns v-if="selected_index == 0" />
				<sets-and-legs-table v-else-if="selected_index == 1" />
			</keep-alive>
		</div>
	</div>
</template>

<script>
import GraphTurns from '../Graph/GraphTurns.vue';
import SetsAndLegsTable from '../Info/SetsAndLegsTable.vue';

export default {
	data() {
		return {
			selected_index: 0,
			tabs: ['Scores', 'Game info']
		}
	},
	components: {
		GraphTurns,
		SetsAndLegsTable,
	},
	mounted() {
		this.selectTab(0)
	},
	methods: {
		selectTab(index) {
			this.selected_index = index;
		}
	}
}
</script>