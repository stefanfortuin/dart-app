<template>
	<div class="w-full h-full flex flex-col">
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div :key="user.id">
				<user-name :user="user" />
				<user-score-and-checkout :user="user" />
				<div class="border-solid border-2 border-gray-200"></div>
				<user-turns :user="user" />
			</div>
		</transition>
		<score-input :user="user" @change="handleShot"/>
	</div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import Turn from '../classes/Turn';
import Shot from '../classes/Shot';

import UserTurns from '../components/UserTurns';
import UserScoreAndCheckout from '../components/UserScoreAndCheckout';
import UserName from '../components/UserName';
import ScoreInput from '../components/ScoreInput.vue';

export default {
	data() {
		return {
			canMakeShot: true,
			turn: undefined
		}
	},
	components: {
		UserTurns,
		UserScoreAndCheckout,
		UserName,
		ScoreInput,
	},
	methods: {
		...mapMutations([
			'switchUserThatDoesTurn',
			'goToNextStep',
			'saveTurnToGame'
		]),

		handleShot(target) {
			if (!this.canMakeShot) return;
			
			const thrown_score = parseInt(target.value);
			if (this.scoreOutOfRange(target.min, target.max, thrown_score)) return;

			if (this.turn == undefined) {
				this.createNewTurn();
			}

			const shot = new Shot()
				.setUser(this.user.id)
				.setDart(this.user.current_dart)
				.setThrownScore(thrown_score);

			this.turn.addShotAndCalculateNewScore(shot);
			this.user.getCheckout();

			if (this.user.hasDartsLeft() && !this.user.hasWon()) {
				this.user.goToNextShot();
				this.resetInputField(target);
				return;
			}

			this.canMakeShot = false;

			if (this.user.hasWon()) {
				this.goToNextStep();
				return;
			}

			setTimeout(() => {
				this.resetInputField(target);
				this.resetForNextTurn();
				this.switchUserThatDoesTurn();
				this.canMakeShot = true;
			}, 800);

		},

		createNewTurn() {
			this.turn = new Turn()
				.setUser(this.user.id)
				.setOldScoreToThrowFrom(this.user.score_to_throw_from)

			this.user.addTurn(this.turn);
			this.saveTurnToGame(this.turn);
		},

		resetInputField(target) {
			target.value = '';
		},

		resetForNextTurn() {
			this.user.goToFirstShot();
			this.turn = undefined;
		},

		scoreOutOfRange(min, max, score) {
			return score < min || score > max;
		}
	},
	computed: {
		...mapGetters({
			user: 'getUserThatDoesTurn',
		})
	}
}
</script>