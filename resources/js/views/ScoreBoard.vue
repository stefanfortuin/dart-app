<template>
	<div>
		scoreboard - {{current_user.name}}
		{{(current_user.last_turn != undefined) ? current_user.last_turn.new_score_to_throw_from : current_user.start_score}}
		<div
			v-for="turn in current_user.turns"
			:key="turn.id"
		>
			{{turn.new_score_to_throw_from}} - {{turn.thrown_score}}
		</div>
		<input
			type="number"
			value=''
			@change="handleTurn"
		>
	</div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import Turn from '../classes/Turn';
export default {
	methods: {
		...mapMutations([
			'switchUserThatDoesTurn',
			'goToNextStep',
			'saveTurnToGame'
		]),

		handleTurn(event) {
			const score = parseInt(event.target.value);
			const turn = new Turn(this.current_user.id, score, this.current_user.score_to_throw_from)
			this.current_user.addTurn(turn)
			this.saveTurnToGame(turn)
			event.target.value = '';

			if (this.current_user.last_turn.new_score_to_throw_from == 0) {
				this.goToNextStep();
				return;
			}

			this.switchUserThatDoesTurn();
		}
	},
	computed: {
		...mapGetters({
			current_user: 'getUserThatDoesTurn',
		})
	}
}
</script>