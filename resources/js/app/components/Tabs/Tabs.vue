<template>
	<div class="w-full flex-100 min-h-32 flex my-2">
		
		<div class="p-2 w-10/12 flex-1 bg-blue-500 rounded-b-lg rounded-tl-lg">
			<transition name="tab-fade" mode="out-in">
			<keep-alive>
				<graph-turns v-if="selected_index == 0" />
				<info-table :leg="current_leg" v-else-if="selected_index == 1" />
			</keep-alive>
			</transition>
		</div>
		<div class="flex flex-col flex-shrink-0">
			<div
				v-for="(tab,index) in tabs"
				:key="index"
				@click="selectTab(index)"
				class="p-3 first:rounded-tr-lg last:rounded-br-lg"
				:class="index == selected_index ? 'bg-blue-500 text-blue-100' : 'bg-blue-100 text-blue-500 text-opacity-75'"
			>
				<svg class="icon">
					<use :href="'assets/sprite.svg#'+ tab"></use>
				</svg>
			</div>
		</div>
	</div>
</template>

<script>
import { mapState } from 'vuex';
import GraphTurns from '../Graph/GraphTurns.vue';
import InfoTable from '../Info/InfoTable.vue';

export default {
	data() {
		return {
			selected_index: 0,
			tabs: ['graph', 'info']
		}
	},
	components: {
		GraphTurns,
		InfoTable,
	},
	mounted() {
		this.selectTab(0)
	},
	computed: {
		...mapState(["current_leg"]),
	},
	methods: {
		selectTab(index) {
			this.selected_index = index;
		}
	}
}
</script>