<template>
	<div class="w-full h-full flex flex-col ">

		<div>
			<user-card-score
				v-for="user in users"
				:key="user.id"
				:user="user"
			/>
		</div>
		<tabs></tabs>
		<score-input @handleTurn="handleTurn" :min="0" :max="180" />
	</div>
</template>

<script>
import { mapMutations, mapState, mapActions } from 'vuex'

import DartTurn from '../classes/DartTurn';

import Tabs from '../components/Tabs/Tabs.vue';
import ScoreInput from '../components/ScoreInput.vue';
import UserCardScore from '../components/UserCard/UserCard.vue';

export default {
	data() {
		return {
			canMakeTurn: true,
		}
	},
	components: {
		ScoreInput,
		UserCardScore,
		Tabs,
	},
	methods: {
		...mapMutations([
			'switchUserThatDoesTurn',
			'setSetWinner',
			'setLegWinner',
			'goToNextStep',
		]),

		...mapActions([
			'switchUserThatStartsNextLeg',
			'addTurnToGame',
			'resetForNextLeg',
			'resetForNextSet',
		]),

		...mapActions({
			notify: 'toast/add',
		}),

		handleTurn(score) {
			if (!this.canMakeTurn) return;

			const thrown_score = parseInt(score);

			let turn = new DartTurn()
				.setUser(this.user_on_turn.id)
				.setThrownScore(thrown_score)
				.setOldScoreToThrowFrom(this.user_on_turn.score_to_throw_from)
				.calculateNewScoreToThrowFrom()

			this.user_on_turn
				.addTurn(turn)
				.getCheckout()
			
			this.addTurnToGame(turn);

			this.canMakeTurn = false;

			if (this.user_on_turn.hasReachedZero()) {
				this.setLegWinner(this.user_on_turn);
				this.user_on_turn.addWonLeg();

				if (this.hasWonSet()) {
					this.user_on_turn.addWonSet()
				}

				if (this.hasWonGame()) {
					this.setSetWinner(this.user_on_turn);
					this.goToNextStep()
					return;
				}

				if (this.hasWonSet()) {
					this.resetForNextSet();
				}
				else {
					this.resetForNextLeg();
				}

				this.switchUserThatStartsNextLeg();
				this.resetScoreField();
			}
			else {
				setTimeout(() => {
					this.switchUserThatDoesTurn();
					this.resetScoreField();
				}, 800);
			}

			this.user_on_turn.updateStats();
		},

		resetScoreField() {
			this.canMakeTurn = true;
		},

		scoreIsOutOfRange(min, max, score) {
			return score < min || score > max;
		},

		hasWonSet() {
			let winning_leg = Math.round((this.total_legs % 2 == 0) ? this.total_legs / 2 + 1 : this.total_legs / 2)
			return this.user_on_turn.legs_won >= winning_leg
		},

		hasWonGame() {
			return this.user_on_turn.sets_won == this.total_sets;
		},
	},
	computed: {
		...mapState({
			total_sets: state => state.total_sets,
			total_legs: state => state.total_legs,
			users: state => state.users,
			user_on_turn: state => state.users.find(u => u.is_on_turn)
		}),
	}
}
</script>