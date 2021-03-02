<template>
	<div class="h-full w-full flex flex-col">
		<div>
			<PlayerInput
				id="player_one"
				label="Speler 1"
				v-model="data.user_one"
			/>
			<PlayerInput
				id="player_two"
				label="Speler 2"
				v-model="data.user_two"
			/>
			<div class="flex flex-col w-full mb-2">
				<label
					for="set_start_score"
					class="mb-1 text-xl font-semibold text-blue-400"
				>Start score</label>
				<input
					type="number"
					min="101"
					max="501"
					name="set_start_score"
					id="set_start_score"
					class="border-2 border-blue-200 text-blue-500 font-bold text-3xl py-2 px-3 rounded-lg"
					v-model="start_score"
				/>
			</div>
			<div class="flex justify-between w-full mb-2">
				<div class="flex flex-col w-1/2">
					<label
						for="set_total_sets"
						class="mb-1 text-xl font-semibold text-blue-400"
					>Sets</label>
					<input
						type="number"
						min="1"
						name="set_total_sets"
						id="set_total_sets"
						class="border-2 border-blue-200 text-blue-500 font-bold text-3xl py-2 px-3 rounded-lg"
						v-model="total_sets"
					/>
				</div>
				<div class="flex flex-col w-1/2">
					<label
						for="set_total_legs"
						class="mb-1 text-xl font-semibold text-blue-400"
					>Legs/set</label>
					<input
						type="number"
						min="1"
						name="set_total_legs"
						id="set_total_legs"
						class="border-2 border-blue-200 text-blue-500 font-bold text-3xl py-2 px-3 rounded-lg"
						v-model="total_legs"
					/>
				</div>
			</div>
		</div>

		<div class="flex flex-col w-full mt-auto">
			<button-action
				@click="handleNextStep()"
				:disabled="!canProceed"
			>Volgende</button-action>

			<button-action href="/stats">Statistieken</button-action>
		</div>
	</div>
</template>

<script>
import PlayerInput from "../components/PlayerInput";
import { mapMutations } from "vuex";
import ButtonAction from "../components/ButtonAction.vue";

export default {
	data() {
		return {
			data: {
				user_one: "",
				user_two: "",
			},
			start_score: 501,
			total_sets: 1,
			total_legs: 1,
		};
	},
	components: {
		PlayerInput,
		ButtonAction,
	},
	computed: {
		canProceed() {
			return this.fieldsAreNotEmpty && this.usersAreNotTheSame;
		},

		usersAreNotTheSame() {
			return (
				this.data.user_one.toLowerCase() != this.data.user_two.toLowerCase()
			);
		},

		fieldsAreNotEmpty() {
			return (
				this.data.user_one != "" &&
				this.data.user_two != "" &&
				this.start_score != ""
			);
		},
	},
	methods: {
		...mapMutations(["setUsers", "goToNextStep", "setStartScore", "setTotalSets", "setTotalLegs"]),

		handleNextStep() {
			if (!this.canProceed) return;

			this.setStartScore(this.start_score);
			this.setTotalSets(this.total_sets);
			this.setTotalLegs(this.total_legs);

			fetch(`/api/users`, {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify(this.data),
			})
				.then((response) => response.json())
				.then((response) => {
					this.setUsers(response);
					this.goToNextStep();
				});
		},
	},
};
</script>