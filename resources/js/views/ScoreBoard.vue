<template>
	<div class="w-full h-full flex flex-col">
		<game-info class="mx-2" />
		<div>
			<user-card-score
				v-for="user in users"
				:key="user.id"
				:user="user"
				:is-on-turn="user == userThatDoesTurn"
			/>
		</div>
		<graph-turns class="mx-2" />
		<score-input
			:user="userThatDoesTurn"
			@handleTurn="handleTurn"
		/>
	</div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import DartTurn from '../classes/DartTurn';
import GraphTurns from '../components/GraphTurns.vue';

import ScoreInput from '../components/ScoreInput.vue';
import GameInfo from '../components/GameInfo.vue';
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
		GraphTurns,
		GameInfo
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

			let turn = new DartTurn()
				.setUser(this.userThatDoesTurn.id)
				.setThrownScore(thrown_score)
				.setOldScoreToThrowFrom(this.userThatDoesTurn.score_to_throw_from)
				.calculateNewScoreToThrowFrom()

			this.saveTurnToGame(turn);

			this.userThatDoesTurn
				.addTurn(turn)
				.getCheckout()

			this.canMakeTurn = false;

			if (this.userThatDoesTurn.hasWon()) {
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