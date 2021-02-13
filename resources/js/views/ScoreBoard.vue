<template>
	<div class="w-full h-full flex flex-col">
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="current_user.id + 1"
				class="text-right text-gray-700 font-semibold text-3xl mb-4"
			>{{current_user.name}}</div>
		</transition>
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="current_user.id + 2"
				class="text-left text-blue-500 font-bold text-6xl mb-6"
			>
				{{(current_user.last_turn != undefined) ? current_user.last_turn.new_score_to_throw_from : current_user.start_score}}
			</div>
		</transition>
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div :key="current_user.id + 3" class="italic">
				<div
					v-for="turn in current_user.turns"
					:key="turn.thrown_score + turn.new_score_to_throw_from"
					class="flex justify-between"
				>
					<div class="text-2xl">
						{{turn.new_score_to_throw_from}}
					</div>
					<div class="text-2xl text-red-500">
						-{{turn.thrown_score}}
					</div>
				</div>
			</div>
		</transition>
		<div class="mt-auto w-full">
			<input
				type="number"
				value=''
				min=0
				max=180
				placeholder="Score"
				@change="handleTurn"
				class="w-full border-2 border-blue-300 py-4 px-5 rounded-lg text-xl"
			>
		</div>
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

			if(score < event.target.min || score > event.target.max) return;

			const turn = new Turn(this.current_user.id, score, this.current_user.score_to_throw_from)
			this.current_user.addTurn(turn)
			this.saveTurnToGame(turn)
			event.target.value = '';

			if (this.current_user.last_turn.new_score_to_throw_from <= 0) {
				this.goToNextStep();
				return;
			}

			setTimeout(() => {
				this.switchUserThatDoesTurn();
			}, 1000);

		}
	},
	computed: {
		...mapGetters({
			current_user: 'getUserThatDoesTurn',
		})
	}
}
</script>