<template>
	<div class="w-full h-full flex flex-col ">
		<game-info />
		<div>
			<user-card-score
				v-for="user in users"
				:key="user.id"
				:user="user"
				:is-on-turn="user == userThatDoesTurn"
			/>
		</div>
		<graph-turns />
		<score-input
			:user="userThatDoesTurn"
			@handleTurn="handleTurn"
		/>
	</div>
</template>

<script>
import { mapMutations, mapGetters, mapState, mapActions } from 'vuex'

import DartTurn from '../classes/DartTurn';
import GraphTurns from '../components/GraphTurns.vue';

import ScoreInput from '../components/ScoreInput.vue';
import GameInfo from '../components/GameInfo.vue';
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
				.setUser(this.userThatDoesTurn.id)
				.setThrownScore(thrown_score)
				.setOldScoreToThrowFrom(this.userThatDoesTurn.score_to_throw_from)
				.calculateNewScoreToThrowFrom()

			this.userThatDoesTurn
				.addTurn(turn)
				.getCheckout()

			this.canMakeTurn = false;

			if (this.userThatDoesTurn.hasReachedZero()) {
				this.userThatDoesTurn.addWonLeg();

				if (this.hasWonSet()) {
					this.userThatDoesTurn.addWonSet()
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
			return this.userThatDoesTurn.legs_won >= winning_leg
		},

		hasWonGame() {
			return this.userThatDoesTurn.sets_won == this.total_sets;
		},
	},
	computed: {
		...mapState({
			total_sets: state => state.total_sets,
			total_legs: state => state.total_legs,
		}),
		...mapGetters({
			userThatDoesTurn: 'getUserThatDoesTurn',
			users: 'getUsers',
		})
	}
}
</script>