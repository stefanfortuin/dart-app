<template>
	<div class="flex flex-col w-full h-full justify-between">
		<div class="text-5xl font-bold text-gray-700 mb-6">
			<span class="bg-clip-text text-transparent bg-gradient-to-br from-blue-600 to-blue-500">{{current_user.name}}</span> heeft gewonnen!
		</div>

		<div
			class="grid grid-cols-2 gap-2"
		>
			<stats-block :title="'Gem/beurt'" :metric="parseFloat(averagePerTurn).toFixed(2)" />
			<stats-block :title="'Hoogste'" :metric="highestTurn" />
		</div>

		<a
			@click="handleNewGame"
			class="text-white font-bold text-2xl h-20 bg-gradient-to-br from-blue-600 to-blue-500 rounded-lg my-2 flex justify-center items-center mt-auto"
		>
			Nieuw Spel
		</a>
	</div>
</template>

<script>
import StatsBlock from '../components/StatsBlock';
import { mapGetters, mapMutations } from 'vuex'
export default {
	components: {
		StatsBlock,
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
			return this.current_user.turns.sort((a,b) => b.thrown_score - a.thrown_score)[0].thrown_score;
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