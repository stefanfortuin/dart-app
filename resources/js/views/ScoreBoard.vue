<template>
	<div class="w-full h-full flex flex-col">
		<user-card-score
			v-for="user in users"
			:key="user.id"
			:user="user"
			:is-on-turn="user == userThatDoesTurn"

		/>
		<score-input
			:user="userThatDoesTurn"
			@change="handleTurn"
		/>
	</div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import Turn from '../classes/Turn';

import ScoreInput from '../components/ScoreInput.vue';
import UserCardScore from '../components/UserCardScore.vue';

export default {
	data() {
		return {
			canMakeTurn: true,
		}
	},
	components: {
		ScoreInput,
		UserCardScore,
	},
	methods: {
		...mapMutations([
			'switchUserThatDoesTurn',
			'goToNextStep',
			'saveTurnToGame'
		]),

		handleTurn(target) {
			if (!this.canMakeTurn) return;

			const thrown_score = parseInt(target.value);
			if (this.scoreIsOutOfRange(target.min, target.max, thrown_score)) return;

			let turn = new Turn()
				.setUser(this.userThatDoesTurn.id)
				.setThrownScore(thrown_score)
				.setOldScoreToThrowFrom(this.userThatDoesTurn.score_to_throw_from)
				.calculateNewScoreToThrowFrom()

			this.saveTurnToGame(turn);

			this.userThatDoesTurn
				.addTurn(turn)
				.getCheckout()

			this.canMakeTurn = false;

			if(this.userThatDoesTurn.hasWon()){
				this.goToNextStep()
				return;
			}

			setTimeout(() => {
				this.resetInputField(target);
				this.switchUserThatDoesTurn();
				this.canMakeTurn = true;
			}, 800);

		},

		resetInputField(target) {
			target.value = '';
		},

		scoreIsOutOfRange(min, max, score) {
			return score < min || score > max;
		}
	},
	computed: {
		...mapGetters({
			userThatDoesTurn: 'getUserThatDoesTurn',
			users: 'getUsers',
		})
	}
}
</script>