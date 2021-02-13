<template>
	<div>
		<div>{{current_user.name}} heeft gewonnen!</div>

		<button @click="handleNewGame">
			Nieuw Spel
		</button>
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