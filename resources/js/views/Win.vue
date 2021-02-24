<template>
	<div class="flex flex-col w-full h-full">
		<div class="text-5xl font-bold text-gray-700 mb-7">
			<span class="bg-clip-text text-transparent bg-blue-500 text-6xl">{{current_user.name}}</span> heeft gewonnen!
		</div>

		<div
			class="grid grid-cols-2 gap-2"
		>
			<stats-block :title="'Gem/beurt'" :metric="parseFloat(averagePerTurn).toFixed(2)" />
			<stats-block :title="'Hoogste'" :metric="highestTurn" />
		</div>

		<graph-turns/>

		<div class="mt-auto">
			<button-action @click="handleNewGame">Nieuw Spel</button-action>
		</div>
		
	</div>
</template>

<script>
import StatsBlock from '../components/StatsBlock';
import { mapGetters, mapMutations } from 'vuex'
import ButtonAction from '../components/ButtonAction.vue';
import GraphTurns from '../components/GraphTurns.vue';
export default {
	components: {
		StatsBlock,
		ButtonAction,
		GraphTurns
	},
	created() {
		this.uploadGame();
	},
	computed: {
		...mapGetters({
			current_user: 'getUserThatDoesTurn',
			users: 'getUsers',
			turns: 'getTurns'
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

		handleNewGame() {
			this.resetCurrentStep()
		},

		uploadGame() {
			let game = {
				users: this.users.map(user => user.id),
				turns: this.turns,
				winner_id: this.current_user.id,
			}

			fetch('https://darts.stefanfortuin.nl/api/game', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(game),
			})
		}
	}
}
</script>