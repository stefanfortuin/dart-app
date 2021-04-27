<template>
	<div class="w-full mt-auto flex h-full items-end text-xl">

		<div class="relative grid grid-rows-4 grid-cols-3 w-full h-full min-h-40 max-h-52 gap-1">
			<transition name="checkout-text">
				<div
					v-if="score.length > 0"
					class="absolute w-full flex justify-center items-center"
					style="top: -3rem"
				>
					<div class="px-2 py-1 bg-blue-100 text-blue-900 font-semibold text-3xl rounded-t h-full">
						{{ formattedScore }}
					</div>
				</div>
			</transition>
			<div
				v-for="i in 9"
				:key="'num-' + i"
				@click="addNumberToScore(i)"
				class="flex justify-center items-center max-h-12 text-blue-800 bg-blue-100 active:bg-blue-400 font-semibold text-2xl rounded"
			>
				{{ i }}
			</div>
			<div
				@click="backspace()"
				class="rounded flex justify-center items-center max-h-12 bg-red-400 active:bg-red-500 text-red-900"
			>
				<svg class="icon">
					<use xlink:href="assets/sprite.svg#backspace"></use>
				</svg>
			</div>
			<div
				@click="addNumberToScore(0)"
				class="flex justify-center items-center max-h-12 text-blue-800 bg-blue-100 active:bg-blue-400 font-semibold text-2xl rounded"
			>
				0
			</div>
			<div
				@click="applyScore()"
				class="rounded flex justify-center items-center max-h-12 bg-green-400 active:bg-green-500 text-green-900"
			>
				<svg class="icon">
					<use xlink:href="assets/sprite.svg#check"></use>
				</svg>
			</div>
		</div>
	</div>
</template>

<script>
import { mapActions } from "vuex";
export default {
	props: ["min", "max"],
	data() {
		return {
			score: [],
		};
	},
	computed: {
		formattedScore() {
			return this.score.join("");
		},
	},
	methods: {
		...mapActions({
			notify: "toast/add",
		}),

		backspace() {
			this.score.splice(this.score.length - 1, 1);
		},
		addNumberToScore(number) {
			this.score.push(number);
		},

		applyScore() {
			if (this.score.length == 0) return;

			const score = this.score.join("");
			if (this.scoreIsOutOfRange(this.min, this.max, score)) {
				this.notify({
					title: "Score moet tussen 0 en 180",
					type: "error",
				});
				return;
			}

			console.log(score);
			this.$emit("handleTurn", score);
			this.score = [];
		},

		scoreIsOutOfRange(min, max, score) {
			return score < min || score > max;
		},
	},
};
</script>