<template>
	<div class="flex flex-col w-full h-full">
		<div class="text-5xl font-bold text-gray-700 mb-7">
			<span class="bg-clip-text text-transparent bg-blue-500">{{current_user.name}}</span> heeft gewonnen!
		</div>

		<div
			class="grid grid-cols-2 gap-2"
		>
			<stats-block :title="'Gem/beurt'" :metric="parseFloat(averagePerTurn).toFixed(2)" />
			<stats-block :title="'Hoogste'" :metric="highestTurn" />
		</div>

		<div class="my-4 h-full p-1 bg-blue-500 rounded-lg">
			<graph-turns/>
		</div>

		<div class="mt-auto">
			<button-action @click="handleNewGame">Nieuw Spel</button-action>
		</div>
		
	</div>
</template>

<script>
import StatsBlock from '../components/StatsBlock';
import { mapState, mapMutations, mapActions } from 'vuex'
import ButtonAction from '../components/ButtonAction.vue';
import GraphTurns from '../components/Graph/GraphTurns.vue';
export default {
	components: {
		StatsBlock,
		ButtonAction,
		GraphTurns
	},
	created() {
		if(window.logged_in_user)
			this.uploadGame();
	},
	computed: {
		...mapState({
			users: state => state.users,
			sets: state => state.sets,
			start_score: state => state.start_score,
			total_sets: state => state.total_sets,
			total_legs: state => state.total_legs,
			current_user: state => state.users.find(user => user.is_on_turn)
		}),

		averagePerTurn(){
			return this.current_user.turns.reduce((t,a) => {return t+=a.thrown_score}, 0) / this.current_user.turns.length;
		},

		highestTurn(){
			return Math.max.apply(Math, this.current_user.turns.map((turn) => {return turn.thrown_score}));
		}
	},
	methods: {
		...mapMutations([
			'resetCurrentStep',
		]),

		...mapActions({
			notify: 'toast/add',
		}),

		handleNewGame() {
			this.resetCurrentStep()
		},

		uploadGame() {
			let game = {
				users: this.users,
				game: {
					sets: this.sets,
					start_score: this.start_score,
					total_sets: this.total_sets,
					total_legs: this.total_legs,
					winner_id: this.current_user.id,
				}
			}

			fetch(`/play/upload-game`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-Token': window.csrf_token
				},
				body: JSON.stringify(game),
			})
			.then((response) => response.json())
			.then((response) => {
				if(response.success == false)
					this.notify({title: response.message, type: 'error'})
			});
		}
	}
}
</script>