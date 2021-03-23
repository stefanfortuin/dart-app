<template>
	<div class="w-full h-full flex flex-col ">
		<game-info />
		<div>
			<user-card-score
				v-for="user in users"
				:key="user.id"
				:user="user"
			/>
		</div>
		<graph-turns />
		<score-input @handleTurn="handleTurn" />
	</div>
</template>

<script>
import { mapMutations, mapState, mapActions } from 'vuex'

import DartTurn from '../classes/DartTurn';
import GraphTurns from '../components/Graph/GraphTurns.vue';

import ScoreInput from '../components/ScoreInput.vue';
import GameInfo from '../components/Info/GameInfo.vue';
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
		GraphTurns,
		GameInfo,
	},
	methods: {
		...mapMutations([
			'switchUserThatDoesTurn',
			'goToNextStep',
			'resetForNextLeg',
			'resetForNextSet',
		]),

		...mapActions([
			'switchUserThatStartsNextLeg',
		]),

		...mapActions({
			notify: 'toast/add',
		}),

		handleTurn(target) {
			if (!this.canMakeTurn) return;

			const thrown_score = parseInt(target.value);

			let turn = new DartTurn()
				.setUser(this.user_on_turn.id)
				.setThrownScore(thrown_score)
				.setOldScoreToThrowFrom(this.user_on_turn.score_to_throw_from)
				.calculateNewScoreToThrowFrom()

			this.user_on_turn
				.addTurn(turn)
				.getCheckout()

			this.canMakeTurn = false;

			if (this.user_on_turn.hasReachedZero()) {
				this.user_on_turn.addWonLeg();

				if (this.hasWonSet()) {
					this.user_on_turn.addWonSet()
				}

				if (this.hasWonGame()) {
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
				this.resetScoreField(target);
			}
			else {
				setTimeout(() => {
					this.switchUserThatDoesTurn();
					this.resetScoreField(target);
				}, 800);
			}
		},

		resetScoreField(target) {
			this.resetInputField(target);
			this.canMakeTurn = true;
		},

		resetInputField(target) {
			target.value = '';
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