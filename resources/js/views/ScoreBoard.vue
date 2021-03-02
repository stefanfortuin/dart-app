<template>
	<div class="w-full h-full flex flex-col ">
		<game-info />
		<div class="transition-transform transform">
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
import { mapMutations, mapGetters, mapState } from 'vuex'
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
			'resetForNextLeg',
			'resetForNextSet',
		]),

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
				console.log('has won leg');
				this.userThatDoesTurn.addWonLeg();

				if(this.hasWonSet()){
					this.userThatDoesTurn.addWonSet()
				}

				if(this.hasWonGame()){
					this.goToNextStep()
					return;
				}

				if(this.hasWonSet()){
					this.resetForNextSet();
				}
				else{
					this.resetForNextLeg();
				}
		
			}

			this.switchUser(target);

		},

		switchUser(target){
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
		},

		hasWonSet(){
			let winning_leg = Math.round((this.total_legs % 2 == 0) ? this.total_legs / 2 + 1 : this.total_legs / 2)
			return this.userThatDoesTurn.legs_won >= winning_leg
		},

		hasWonGame(){
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