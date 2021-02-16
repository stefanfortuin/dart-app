<template>
	<div class="w-full h-full flex flex-col">
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="user.id + 1"
				class="text-left text-gray-700 font-semibold text-3xl mb-3"
			>{{user.name}}</div>
		</transition>
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="user.id + 2"
				class="flex justify-between font-bold mb-4"
			>
				<div class="text-blue-500 text-6xl">
					{{user.score_to_throw_from}}
				</div>
				<div class="text-2xl flex items-end">
					{{user.checkout}}
				</div>
			</div>
		</transition>
		<div class="border-solid border-2 border-gray-200"></div>
		<transition
			name="component-fade"
			mode="out-in"
		>
			<div
				:key="user.id + 3"
				class="italic mb-3 overflow-y-scroll"
			>
				<div
					v-for="turn in user.turns"
					:key="turn.thrown_score + turn.new_score_to_throw_from"
					class="flex justify-between"
				>
					<div class="text-2xl">
						{{turn.new_score_to_throw_from}}
					</div>
					<div class="flex">
						<div class="mr-3 text-gray-700 text-opacity-70 flex justify-end items-end">
							{{turn.shotScoresInStringFormat}}
						</div>
						<div class="text-2xl text-red-500">

							-{{turn.thrown_score}}
						</div>
					</div>
				</div>
			</div>
		</transition>
		<div class="mt-auto w-full">
			<transition
				name="component-fade"
				mode="out-in"
			>
				<label
					for="dart-id"
					:key="'dart-' + user.current_dart"
					class="text-blue-500 font-bold text-xl"
				>Pijl - {{user.current_dart}}</label>
			</transition>
			<input
				type="number"
				id="dart-id"
				value=''
				min=0
				max=60
				placeholder="Score"
				@change="handleShot"
				class="w-full border-2 border-blue-300 py-4 px-5 mt-3 rounded-lg text-xl"
			>
		</div>
	</div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import Turn from '../classes/Turn';
import Shot from '../classes/Shot';

export default {
	data() {
		return {
			canMakeShot: true,
			turn: undefined
		}
	},
	methods: {
		...mapMutations([
			'switchUserThatDoesTurn',
			'goToNextStep',
			'saveTurnToGame'
		]),

		handleShot(event) {
			if (!this.canMakeShot) return;

			const target = event.target;
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