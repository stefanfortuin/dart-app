<template>
	<div class="w-full flex-grow mt-4">
		<div class="w-full flex">
			<div
				v-for="(tab,index) in tabs"
				:key="index"
				@click="selectTab(index)"
				class="w-1/2 flex justify-center items-center p-1 text-lg font-semibold text-white rounded-t-lg"
				:class="index == selected_index ? 'bg-blue-500' : 'bg-blue-200'"
			>
				{{tab}}
			</div>
		</div>
		<keep-alive>
			<graph-turns v-show="selected_index == 0" />
		</keep-alive>
		<keep-alive>
			<game-info v-show="selected_index == 1"/>
		</keep-alive>
	</div>
</template>

<script>
import GameInfo from '../Info/GameInfo.vue';
import GraphTurns from '../Graph/GraphTurns.vue';

export default {
	data() {
		return {
			selected_index: 0,
			tabs: ['Grafiek', 'Sets en Legs']
		}
	},
	components: {
		GraphTurns,
		GameInfo,
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