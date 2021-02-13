<template>
	<div class="flex flex-col w-full h-full justify-between">
		<div class="text-5xl font-bold text-gray-800">
			<span class="text-blue-500">{{current_user.name}}</span> heeft gewonnen!
		</div>

		<a
			@click="handleNewGame"
			class="text-white font-bold text-2xl h-20 bg-blue-500 rounded-lg my-2 flex justify-center items-center mt-auto"
		>
			Nieuw Spel
		</a>
	</div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
export default {
	created() {
		this.uploadGame();
	},
	computed: {
		...mapGetters({
			current_user: 'getUserThatDoesTurn',
			users: 'getUsers',
			turns: 'getTurns'
		})
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

			console.log(game);

			fetch('http://localhost/api/game', {
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