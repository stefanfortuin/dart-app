<template>
	<div class="w-full h-full flex flex-col">
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="current_user.id + 1"
				class="text-left text-gray-700 font-semibold text-3xl mb-3"
			>{{current_user.name}}</div>
		</transition>
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="current_user.id + 2"
				class="flex justify-between font-bold mb-6"
			>
				<div class="text-blue-500 text-6xl">
					{{current_user.score_to_throw_from}}
				</div>
				<div class="text-2xl flex items-end">
					{{current_user.checkout}}
				</div>
			</div>
		</transition>
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="current_user.id + 3"
				class="italic mb-3 overflow-y-scroll"
			>
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
	data(){
		return{
			canMakeTurn: true,
		}
	},
	methods: {
		...mapMutations([
			'switchUserThatDoesTurn',
			'goToNextStep',
			'saveTurnToGame'
		]),

		handleTurn(event) {
			const score = parseInt(event.target.value);

			if(!this.canMakeTurn) return;
			if (score < event.target.min || score > event.target.max) return;

			const turn = new Turn(this.current_user.id, score, this.current_user.score_to_throw_from)
			this.current_user.addTurnAndGetCheckout(turn)
			this.saveTurnToGame(turn)
			event.target.value = '';

			this.canMakeTurn = false;

			if (this.current_user.score_to_throw_from <= 0) {
				this.goToNextStep();
				return;
			}

			setTimeout(() => {
				this.switchUserThatDoesTurn();
				setTimeout(() => {
					this.canMakeTurn = true;
				}, 200);
				
			}, 800);

		},
	},
	computed: {
		...mapGetters({
			current_user: 'getUserThatDoesTurn',
		})
	}
}
</script>