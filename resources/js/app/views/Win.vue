<template>
	<div class="flex flex-col w-full h-full">
		<div class="text-5xl font-bold text-gray-700 mb-2 flex flex-col justify-center items-center">
			<user-name class="text-blue-500" :user="current_user" />
			<span class="text-base">heeft gewonnen</span>
		</div>

		<div class="my-1">
			<game-stats />
		</div>

		<div class="mt-auto">
			<button-action @click="handleNewGame">Nieuw Spel</button-action>
		</div>
		
	</div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'
import ButtonAction from '../components/ButtonAction.vue';
import GraphTurns from '../components/Graph/GraphTurns.vue';
import UserName from '../components/UserCard/UserName';
import GameStats from '../components/Stats/GameStats.vue';

export default {
	components: {
		ButtonAction,
		GraphTurns,
		UserName,
		GameStats
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