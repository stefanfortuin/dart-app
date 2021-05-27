<template>
	<div class="flex flex-col w-full h-full">
		<div class="text-5xl font-bold text-gray-700 mb-2 flex flex-col justify-center items-center">
			<user-name class="text-blue-500" :user="current_user" />
			<span class="text-base">heeft gewonnen</span>
		</div>

		<div class="my-1 bg-blue-500 p-2 rounded-lg">
			<info-table :leg="legData" />
		</div>

		<div>
			<div>
				<div @click="setSetIndex(current_set_index - 1)">Vorige</div>
				<div>{{current_set_index}}/{{total_sets}}</div>
				<div @click="setSetIndex(current_set_index - 1)">Volgende</div>
			</div>
			<div>
				<div @click="setLegIndex(current_leg_index - 1)">Vorige</div>
				<div>{{current_leg_index}}/{{total_legs}}</div>
				<div @click="setLegIndex(current_leg_index + 1)">Volgende</div>
			</div>
		</div>

		<div class="mt-auto">
			<button-action @click="handleNewGame">Nieuw Spel</button-action>
		</div>
		
	</div>
</template>

<script>
import { mapState, mapMutations, mapActions, mapGetters } from 'vuex'
import ButtonAction from '../components/ButtonAction.vue';
import GraphTurns from '../components/Graph/GraphTurns.vue';
import UserName from '../components/UserCard/UserName';
import InfoTable from '../components/Info/InfoTable.vue';

export default {
	data(){
		return{
			current_set_index: 1,
			current_leg_index: 1,
		}
	},
	components: {
		ButtonAction,
		GraphTurns,
		UserName,
		InfoTable
	},
	created() {
		if(window.logged_in_user)
			this.uploadGame();
	},
	computed: {
		...mapGetters(['getLegData']),

		...mapState({
			current_user: state => state.users.find(user => user.is_on_turn),
			total_sets: state => state.total_sets,
			total_legs: state => state.total_legs
		}),

		legData(){
			let leg = this.getLegData(this.current_set_index, this.current_leg_index);
			console.log(leg);
			return leg;
		}
	},
	methods: {
		...mapMutations([
			'resetCurrentStep',
		]),

		...mapActions(['uploadGame']),

		setLegIndex(id){
			if(id > this.total_legs) return;
			this.current_leg_index = id;
		},

		setSetIndex(id){
			if(id > this.total_sets) return;
			this.current_set_index = id;
		},

		handleNewGame() {
			this.resetCurrentStep()
		},
	}
}
</script>