<template>
	<div class="w-full flex-1 max-h-52 flex my-2">
		
		<div class="p-1 px-2 w-10/12 flex-1 bg-blue-500 rounded-b-lg rounded-tl-lg">
			<transition name="tab-fade" mode="out-in">
			<keep-alive>
				<graph-turns v-if="selected_index == 0" />
				<sets-and-legs-table v-else-if="selected_index == 1" />
			</keep-alive>
			</transition>
		</div>
		<div class="flex flex-col">
			<div
				v-for="(tab,index) in tabs"
				:key="index"
				@click="selectTab(index)"
				class="p-4 py-3 first:rounded-tr-lg last:rounded-br-lg"
				:class="index == selected_index ? 'bg-blue-500 text-blue-100' : 'bg-blue-200 text-blue-400'"
			>
				<svg class="icon">
					<use :xlink:href="'assets/sprite.svg#'+ tab"></use>
				</svg>
			</div>
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
			tabs: ['graph', 'info']
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